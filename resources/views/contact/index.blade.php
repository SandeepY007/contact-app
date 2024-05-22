<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route('contacts.create') }}"
                    class="text-blue-500 hover:underline">{{ __('Add Contacts') }}</a>
            </h2>
            <div class="ml-4">
                <form action="/import-contacts" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex">
                        <input type="file" name="csv" id="csv"
                            class="border border-gray-300 rounded-lg px-3 py-1">
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white font-bold py-1 px-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-2">Upload</button>
                </form>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">ID
                            </th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Phone
                            </th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">Email
                            </th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 text-left text-sm uppercase font-bold">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $contact->id }}</td>
                                <td class="py-2 px-4">{{ $contact->phone }}</td>
                                <td class="py-2 px-4">{{ $contact->email }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('contacts.edit', $contact->id) }}"
                                        class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
