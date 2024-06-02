<?php

namespace App\Livewire;

use Livewire\Component;

class ContactByCategory extends Component
{
    public $category;
    public $contacts;

    // Mount method to initialize the component with the passed parameter
    public function mount($category)
    {
        $this->contacts = $category->contact;
    }
    public function render()
    {
        return view('livewire.contact-by-category');
    }
}
