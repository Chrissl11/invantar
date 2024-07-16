@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="h2">Inventare</h2>
    <table class="table is-fullwidth table-primary">
        <thead>
        <tr>
            <th>ID</th>
            <th>Inventar Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventories as $inventory)
            <tr>
                <td>
                    <a href="{{ route('inventories.show', $inventory->id) }}">
                        {{ $inventory->id }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('inventories.show', $inventory->id) }}">
                        {{ $inventory->inventory_name }}
                    </a>
                </td>
                <td>
                    <div class="buttons">
                        <a class="button is-small is-info" href="{{ route('inventories.edit', $inventory->id) }}">Bearbeiten</a>
                        <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST"
                               style="display: inline-block;" onsubmit="return confirm('Sind Sie sicher, dass Sie dieses Inventar löschen möchten?');">
                            @csrf
                            @method('DELETE')
                            <button class="button is-small is-danger" type="submit">Löschen</button>
                        </form>
                </td>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3 class="h3">Neues Inventar erstellen</h3>
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <div class="field">
            <label class="label">Inventar Name</label>
            <div class="control">
                <input class="input" type="text" value="{{old('inventory_name')}}" required name="inventory_name" >
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" type="submit">Create</button>
        </div>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
