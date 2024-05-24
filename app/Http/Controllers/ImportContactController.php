<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportContactController extends Controller
{
    public function importContacts(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv',
        ]);
        //read csv file and skip data
        $file = $request->file('csv');
        $handle = fopen($file->path(), 'r');

        //skip the header row
        fgetcsv($handle);

        $chunksize = 2;
        while(!feof($handle))
        {
            $chunkdata = [];

            for($i = 0; $i<$chunksize; $i++)
            {
                $data = fgetcsv($handle);
                if($data === false)
                {
                    break;
                }
                $chunkdata[] = $data; 
            }

            $this->getchunkdata($chunkdata);
        }
        fclose($handle);

        return redirect()->route('contacts.index')->with('success', 'Data has been added successfully.');
    }

    public function getchunkdata($chunkdata)
    {
        foreach($chunkdata as $column){
            $name = $column[0];
            $email = $column[1];
            $phone = $column[2];
            

            //create new employee
            $contact = new Contact();
            $contact->user_id = Auth::user()->id;
            $contact->name = $name;
            $contact->email = $email;
            $contact->phone = $phone;
            $contact->save();
        }
    }
}
