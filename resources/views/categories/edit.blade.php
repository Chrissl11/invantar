<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategorien') }}
        </h2>
    </x-slot>

    <div class="box">
        <h3 class="h3">"{{ $category->category_name }}"</h3>
    </div>


        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

                <div class="field">
                    <label class="label">Kategorie Name</label>
                    <div class="control">
                        <input class="input"  type="text" value="{{ $category->category_name }}" required name="category_name">
                    </div>
                </div>

                <div class="field">
                    <button class="btn btn-success" type="submit">Aktualisieren</button>
                </div>

        </form>
</x-app-layout>

