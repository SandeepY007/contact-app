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
            <input type="text" wire:model.debounce.300ms="categoryName" placeholder="Search by Name"
                class="border rounded p-2 mr-2">
            <button wire:click="applyFilters"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Apply Filters</button>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">ID</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Name</th>
                    <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Contacts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $data)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $data->id }}</td>
                        <td class="py-2 px-4">{{ $data->name }}</td>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold"><a
                                href="/contacts-by-category/{{ $data->id }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">Contacts</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
