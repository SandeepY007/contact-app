<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCategoryMap extends Model
{
    use HasFactory;

    protected $table = 'contact_category_map';
    protected $guarded = [];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'category_contact_map', 'category_id', 'contact_id');
    }

}
