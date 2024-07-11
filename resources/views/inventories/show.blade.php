@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <h1>Inventar Details</h1>

        <div class="box">
            <h2>{{ $inventory->inventory_name }}</h2>
        </div>


            <h3>Produkte</h3>
            @if($inventory->products->isEmpty())
                <p>Keine Produkte verfügbar.</p>
            @else
                <table class="table is-fullwidth">
                    <thead>
                    <tr>
                        <th>Produkt-ID</th>
                        <th>Produktname</th>
                        <th>Kaufpreis</th>
                        <th>Restwert</th>
                        <th>Beschreibung</th>
                        <th>Kategorie</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inventory->products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_purchasePrice}}</td>
                            <td>{{$product->product_residualValue}}</td>
                            <td>{{$product->product_description}}</td>
                            <td> @foreach($product->categories as $category)
                                {{ $category->category_name }}@if(!$loop->last), @endif
                            @endforeach
                            </td>
                            <td>{{$product->status->status_name}}</td>
                            <td>
                                <a class="button is-small is-warning" href="{{ route('products.edit', $product->id) }}">Bearbeiten</a>
                                <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button is-small is-danger" type="submit">Löschen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

                <div class="box">
                    <h3>Neues Produkt hinzufügen</h3>
                    <form action="{{ route('products.store', ['inventory_id' => $inventory->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

                        <div class="field">
                            <label class="label">Produkt Name</label>
                            <div class="control">
                                <input class="input" type="text" name="product_name" placeholder="Produkt Name" required>
                            </div>
                        </div>
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
                        <div class="field">
                            <label class="label">Beschreibung des Produkts</label>
                            <div class="control">
                                <textarea class="textarea" name="product_description" placeholder="Beschreibung des Produkts eingeben" required></textarea>
                            </div>
                        </div>
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
                                <a class="button is-small is-link" href="{{ route('categories.create', ['inventory_id' => $inventory->id]) }}">Neue Kategorie erstellen</a>
                            </div>
                        </div>
                        <div class ="field">
                            <label class="label">Status</label>
                            <div class ="controle">
                                <select class="input" name="status_id" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button class="button is-primary" type="submit">Hinzufügen</button>
                        </div>
                    </form>
                </div>



@endsection
