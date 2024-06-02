<?php

namespace App\Http\Controllers;

use App\Models\ContactCategory;
use Illuminate\Http\Request;

class ContactCategoryController extends Controller
{
    public function index(){
        $category = ContactCategory::all();
        return view('category.index', compact('category'));
    }

}
