<?php

namespace App\Livewire;
use App\Models\ContactCategory as ContCategory;
use Livewire\Component;

class ContactCategory extends Component
{
    public $category;
    public $categoryName;

    public function mount()
    {
        $this->category = $this->fetchCategory();
    }

    public function applyFilters()
    {
        $this->category = $this->fetchCategory();
    }

    protected function fetchCategory(){
        return ContCategory::query()
        ->when($this->categoryName, function($query){
            $query->where('name', 'like', '%'.$this->categoryName.'%');
        })->get();
    }
    public function render()
    {
        return view('livewire.contact-category');
    }
}
