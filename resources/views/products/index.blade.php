@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="h2">Inventar </h2>

    <h3 class="h3">Produkte</h3>
    @if($products->isEmpty())
        <p>Keine Produkte verfügbar.</p>
    @else
        <table class="table is-fullwidth table-primary">
            <thead>
            <tr>
                <th>ID</th>
                <th>Produktname</th>
                <th>Kaufpreis</th>
                <th>Restwert</th>
                <th>Beschreibung</th>
                <th>Kategorie</th>
                <th>Status</th>
                <th>Inventarliste</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_purchasePrice }}</td>
                    <td>{{ $product->product_residualValue }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>
                        @foreach($product->categories as $category)
                            {{ $category->category_name }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $product->status->status_name }}</td>
                    <td>{{$product->inventory->inventory_name}}
                    <td>
                        <a class="button is-small is-info" href="{{ route('products.edit', $product->id) }}">Bearbeiten</a>
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

@endsection
