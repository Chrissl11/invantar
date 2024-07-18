@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">

    <h3 class="h3">Produkt "{{$product->product_name}}" bearbeiten</h3>

    <form action="{{ route('products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')


        <div class="field">
            <label class="label">Produktname</label>
            <div class="control">
                <input class="input" type="text" name="product_name" value="{{$product->product_name}}" required>
            </div>
        </div>

        <div class="field is-grouped">


            <div class="field">
                <label class="label">Produktnummer</label>
                <div class="control">
                    <input class="input" type="text" name="product_number" value="{{$product->product_number}}" required>
                 </div>
            </div>

            <div class="field">
                <label class="label">Verwendungsbeginn (Date, Pflichtfeld)</label>
                <div class="control">
                    <input class="input" type="date" name="usage_start_date" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Verwendungsende (Date, optional)</label>
                <div class="control">
                    <input class="input" type="date" name="usage_end_date">
                </div>
            </div>

            <div class="field">
                <label class="label">Anschaffungspreis</label>
                <div class="control">
                    <input class="input" type="number" step="0.01" name="product_purchasePrice" value="{{$product->product_purchasePrice}}" required>
                </div>
            </div>

        </div>

        <div class="field is-grouped">
            <div class="field">
                <label class="label">Kategorie</label>
                <div class="control">
                    <div class="select">
                        <select name="category_id[]" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($product->categories->contains($category->id)) selected @endif>{{ $category->category_name }}</option>
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
                                <option value="{{ $status->id }}" @if($product->status_id == $status->id) selected @endif>{{ $status->status_name }}</option>
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
                                <option value="{{$inventory->id}}" @if($product->inventory_id == $inventory->id) selected @endif >{{$inventory->inventory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <br><br><br><br>

        <div class="field">
            <label class="label">Verwendung/Ort</label>
            <div class="control">
                <textarea class="textarea" name="product_description" >{{$product->product_description}}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="btn btn-success">Produkt aktualisieren</button>
            </div>
        </div>
    </form>
    </div>
@endsection
