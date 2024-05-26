<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\ContactCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ContactCategory::all();
        return view('contact.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:10',
            'profile_image' => 'nullable',
        ]);
        $path = $this->storeImageInPublic($request->profile_image);
        $data['profile_image'] = $path;
        $contact = Contact::create($data);
        if (isset($request->category_id)) {
            $data = [];
            foreach ($request->category_id as $id) {
                $data[] = [
                    'contact_id' => $contact->id,
                    'category_id' => $id
                ];
            }
            DB::table('contact_category_map')->insert($data);
        }
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function storeImageInPublic($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        try {
            // $uploadedImage = $request->file('imagePath');
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $imageName);
            return env('APP_URL') . 'upload/' . $imageName;
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return env('APP_URL') . 'upload/' . $imageName;;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        $categories = ContactCategory::all();
        return view('contact.edit', compact('contact', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, string $id)
    {

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:10',
            'profile_image' => 'nullable',
        ]);
        if ($request->hasFile('profile_image')) {
            $path = $this->storeImageInPublic($request->profile_image);
            $data['profile_image'] = $path;
        }{
            $data['profile_image'] = $request->profile_image;
        }
        $contact = Contact::findOrFail($id);
        $contact->update($data);

        if (isset($request->category_id)) {
            DB::table('contact_category_map')->where('contact_id', $id)->delete();
            $data = [];
            foreach ($request->category_id as $id) {
                $data[] = [
                    'contact_id' => $contact->id,
                    'category_id' => $id
                ];
            }
            DB::table('contact_category_map')->insert($data);
        }
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::destroy($id);
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    /**
     * Check if a string is a base64 encoded image.
     */
    private function isBase64($string)
    {
        if (strpos($string, ';base64,') !== false) {
            return true;
        }
        return false;
    }
}
