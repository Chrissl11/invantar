@extends('layouts.app')

@section('content')

    <h1>Inventar Bearbeiten</h1>

    <div class="box">
        <h2>{{ $inventory->inventory_name }}</h2>
    </div>

    <form method="POST" action="{{ route('inventories.update', $inventory->id) }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label">Inventory Name</label>
            <div class="control">
                <input class="input"  type="text" value="{{ $inventory->inventory_name }}" required name="inventory_name">
            </div>
        </div>

        <div class="control">
            <button class="button is-primary" type="submit">Aktualisieren</button>
        </div>
    </form>

@endsection
