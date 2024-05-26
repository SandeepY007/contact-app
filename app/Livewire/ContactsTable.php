<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactsTable extends Component
{
    public $contacts;
    public $searchName = '';
    public $searchPhone = '';
    public $searchEmail = '';

    public function mount()
    {
        $this->contacts = $this->fetchContacts();
    }

    public function updated($propertyName)
    {
        $this->contacts = $this->fetchContacts();
    }

    public function applyFilters()
    {
        $this->contacts = $this->fetchContacts();
    }

    protected function fetchContacts()
    {
        return Contact::query()
            ->when($this->searchName, function ($query) {
                $query->where('name', 'like', '%' . $this->searchName . '%');
            })
            ->when($this->searchPhone, function ($query) {
                $query->where('phone', 'like', '%' . $this->searchPhone . '%');
            })
            ->when($this->searchEmail, function ($query) {
                $query->where('email', 'like', '%' . $this->searchEmail . '%');
            })
            ->get();
    }

    public function deleteContact($id)
    {
        Contact::find($id)->delete();
        $this->contacts = $this->fetchContacts(); // Refresh the contacts list
        session()->flash('success', 'Contact deleted successfully.');
    }

    public function exportContacts()
    {
        $contacts = $this->contacts->toArray();
        $csvData = $this->arrayToCsv($contacts);

        return response()->streamDownload(function () use ($csvData) {
            echo $csvData;
        }, 'contacts.csv');
    }

    private function arrayToCsv(array $array)
    {
        if (count($array) == 0) {
            return null;
        }

        $output = fopen('php://temp', 'w');
        fputcsv($output, array_keys($array[0]));
        foreach ($array as $row) {
            fputcsv($output, $row);
        }
        rewind($output);
        $csvData = stream_get_contents($output);
        fclose($output);

        return $csvData;
    }

    public function render()
    {
        return view('livewire.contacts-table');
    }
}
