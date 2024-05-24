<div>
    @if (session()->has('success'))
        <div class="container mx-auto pl-14">
            <ul>
                <li>{!! session('success') !!}</li>
            </ul>
        </div>
    @endif

    <div class="mb-4 flex justify-between">
        <div>
            <label for="phone">Phone</label>
            <input type="text" wire:model.debounce.300ms="searchPhone" placeholder="Search by Phone" class="border border-gray-300 rounded-lg">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" wire:model.debounce.300ms="searchEmail" placeholder="Search by Email" class="border border-gray-300 rounded-lg">
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">ID</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Profile Image</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Phone</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Email</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Actions</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Profile</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $contact->id }}</td>
                        <td class="py-2">
                            @if ($contact->profile_image)
                                <img src="{{ $contact->profile_image }}" class="w-5" alt="">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
