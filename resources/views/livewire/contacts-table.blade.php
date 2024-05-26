<!-- resources/views/livewire/contacts-table.blade.php -->

<div>
    @if (session()->has('success'))
        <div class="container mx-auto pl-14">
            <ul>
                <li>{!! session('success') !!}</li>
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-4 py-2">
            <input type="text" wire:model.debounce.300ms="searchName" placeholder="Search by Name" class="border rounded p-2 mr-2">
            <input type="text" wire:model.debounce.300ms="searchPhone" placeholder="Search by Phone" class="border rounded p-2 mr-2">
            <input type="text" wire:model.debounce.300ms="searchEmail" placeholder="Search by Email" class="border rounded p-2">
            <button wire:click="applyFilters" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Apply Filters</button>
            <button wire:click="exportContacts" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">Export Contacts</button>
            <div class="">
                <form action="/import-contacts" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <input type="file" name="csv" id="csv" class="border border-gray-300 rounded-lg px-3 py-1">
                        <button type="submit" class="bg-blue-500 text-white font-bold p-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-2">Import</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">ID</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Profile Image</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Phone</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Email</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Actions</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Profile</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $contact->id }}</td>
                        <td class="py-2">
                            @if ($contact->profile_image)
                                <img src="{{ $contact->profile_image }}" class="w-20" alt="">
                            @else
                                <span>N.A</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $contact->phone }}</td>
                        <td class="py-2 px-4">{{ $contact->email }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <button wire:click="deleteContact({{ $contact->id }})" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                        <td><a href="/update-profile-image/{{ $contact->id }}" class="btn btn-sm btn-primary">Update Profile Image</a></td>
                        <td>
                            @foreach ($contact->categories as $category)
                                <a href=""><span>{{$category->name}}</span></a><br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
