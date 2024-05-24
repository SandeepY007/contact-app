<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route('contacts.create') }}" class="text-blue-500 hover:underline">{{ __('Add Contacts') }}</a>
            </h2>
            <div class="ml-4">
                <form action="/import-contacts" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <input type="file" name="csv" id="csv" class="border border-gray-300 rounded-lg px-3 py-1">
                        <button type="submit" class="bg-blue-500 text-white font-bold p-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-2">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:contacts-table />
        </div>
    </div>
</x-app-layout>
