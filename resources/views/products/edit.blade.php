@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Produkt "{{$product->product_name}}" bearbeiten</h3>

    <form action="{{ route('products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
       {{-- <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">--}}

        <div class="field">
            <label class="label">Produktname</label>
            <div class="control">
                <input class="input" type="text" name="product_name" value="{{$product->product_name}}" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Produktnummer</label>
            <div class="control">
                <input class="input" type="text" name="product_number" value="{{$product->product_number}}" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Kaufpreis</label>
            <div class="control">
                <input class="input" type="number" step="0.01" name="product_purchasePrice" value="{{$product->product_purchasePrice}}" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Restwert</label>
            <div class="control">
                <input class="input" type="number" step="0.01" name="product_residualValue" value="{{$product->product_residualValue}}" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Beschreibung</label>
            <div class="control">
                <textarea class="textarea" name="product_description" required>{{$product->product_description}}</textarea>
            </div>
        </div>

        <div class="field">
            <label class="label">Kategorie</label>
            <div class="control">
                <div class="select">
                    <select name="category_id[]" multiple>
                        @foreach($product->categories as $category)
                            <option value="{{ $category->id }}" @if($product->categories->contains($category->id)) selected @endif>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Status</label>
            <div class="control">
                <select class="input" name="status_id" required>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @if($product->status_id == $status->id) selected @endif>{{ $status->status_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Produkt aktualisieren</button>
            </div>
        </div>
    </form>
@endsection
