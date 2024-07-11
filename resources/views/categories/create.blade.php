@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Kategorien</h1>
    <table class="table is-fullwidth">
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

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="hidden" name="inventory_id" value="{{ $inventory_id }}">
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
    <br><br><br>
    <div class="control">
        <a class="button is-secondary" href="{{ url('/inventories/' . $inventory_id) }}">Zurück</a>
    </div>
@endsection
