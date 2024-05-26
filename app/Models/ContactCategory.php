<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    use HasFactory;
    protected $table = 'contact_category';
    protected $guarded = [];
    public function contact(){
        return $this->belongsToMany(Contact::class, 'contact_category_map', 'category_id', 'contact_id');
    }
}
