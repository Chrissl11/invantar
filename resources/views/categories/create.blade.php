<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategorien') }}
        </h2>
    </x-slot>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="field">
            <label class="label">Neue Kategorie erstellen</label>
            <div class="control">
                <input class="input" type="text" name="category_name" placeholder="Kategoriename" required>
            </div>
        </div>

        <div class="control">
            <button class="btn btn-success" type="submit">Erstellen</button>
        </div>
    </form>


    <table class="table is-fullwidth table-primary">
        <thead>
        <tr>
            <th>Kategorie</th>
            <th>Aktion</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-sm btn-primary" href="{{ route('categories.edit',[$category->id]) }}">Bearbeiten</a>
                        <button class="btn btn-sm btn-danger" type="submit">Löschen</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
