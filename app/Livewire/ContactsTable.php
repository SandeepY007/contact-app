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

    public function render()
    {
        return view('livewire.contacts-table');
    }
}
