@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="field">
            <label class="label">Neue Kategorie erstellen</label>
            <div class="control">
                <input class="input" type="text" name="category_name" placeholder="Kategoriename" required>
            </div>
        </div>

        <div class="control">
            <button class="button is-primary" type="submit">Kategorie erstellen</button>
        </div>
    </form>

    <h2 class="h2">Kategorien</h2>
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
                        <input type="hidden" name="inventory_id" value="{{ $inventory_id }}">
                        @method('DELETE')
                        <button class="button is-small is-danger" type="submit">Löschen</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
