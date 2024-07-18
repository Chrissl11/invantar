@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="box">
    <h3 class="h4">Neues Produkt hinzufügen</h3>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="field">
            <label class="label">Produkt Name</label>
            <div class="control">
                <input class="input" type="text" name="product_name" placeholder="Produkt Name" required>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="field">
                <label class="label">Produktnummer</label>
                <div class="control">
                    <input class="input" type="text" name="product_number" placeholder="Nummer" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Kaufpreis</label>
                <div class="control">
                    <input class="input" type="number" name="product_purchasePrice" placeholder="Kaufpreis" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Restwert</label>
                <div class="control">
                    <input class="input" type="number" name="product_residualValue" placeholder="Restwert" required>
                </div>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="field">
                <label class="label">Kategorie</label>
                <div class="control">
                    <div class="select">
                        <select name="category_id[]" multiple>
                            <option value="" disabled selected>Wählen Sie eine Kategorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Status</label>
                <div class="control">
                    <div class="select">
                        <select class="input" name="status_id" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Inventarliste</label>
                <div class="controle">
                    <div class="select">
                        <select class="input" name="inventory_id" required>
                            <option value="" disabled selected>Wählen Sie eine Inventarliste</option>
                        @foreach($inventories as $inventory)
                            <option value="{{$inventory->id}}">{{$inventory->inventory_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
        <div>
            <label class="label">Beschreibung des Produkts</label>
            <div class="control">
                <textarea class="textarea" name="product_description" placeholder="Beschreibung des Produkts eingeben" required></textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="btn btn-success" type="submit">Hinzufügen</button>
            </div>
        </div>
    </form>
</div>
@endsection