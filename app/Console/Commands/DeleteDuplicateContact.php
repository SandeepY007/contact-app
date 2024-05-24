<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;

class DeleteDuplicateContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-duplicate-contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contacts = Contact::all();
        foreach($contacts as $contact){
            $contactCount = Contact::where('email', $contact->email)->count();
            if($contactCount > 1){
                Contact::destroy($contact->id);
                echo 'Duplicate Contact Deleted Successfully <br>';
            }else{
                echo 'No Duplicate Contact Exists <br>';
            }
        }
        $this->info('Command Executed Successfully');
    }
}
