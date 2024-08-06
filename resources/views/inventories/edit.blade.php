<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventarliste bearbeiten') }}
        </h2>
    </x-slot>



    <form method="POST" action="{{ route('inventories.update', $inventory->id) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label">Inventar Name</label>
            <div class="box">
                <h3 class="h3">"{{ $inventory->inventory_name }}"</h3>
            </div>


            <div class="control">
                <input class="input"  type="text" value="{{ $inventory->inventory_name }}" required name="inventory_name">
            </div>
        </div>

        <div class="control">
            <button class="btn btn-success" type="submit">Aktualisieren</button>
        </div>
    </form>

</x-app-layout>
