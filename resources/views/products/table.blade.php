{{--
<div class="container">
    <div class="card">
        <div class="card-header">Produkte</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
--}}



<div class="table-responsive">
    <table id="products-table" class="table is-fullwidth table-primary">
        <thead>
        <tr>
            <th class="sortable" data-sort="id">ID</th>
            <th class="sortable" data-sort="product_name">Produktname</th>
            <th class="sortable" data-sort="product_number">Produktnummer</th>
            <th class="sortable" data-sort="product_purchasePrice">Anschaffungspreis</th>
            <th class="sortable" data-sort="product_description">Verwendung/Ort</th>
            <th class="sortable" data-sort="category">Kategorie</th>
            <th class="sortable" data-sort="status_name">Status</th>
            <th class="sortable" data-sort="usage_start_date">Verwendungsbeginn</th>
            <th class="sortable" data-sort="usage_end_date">Verwendungsende</th>
            <th class="sortable" data-sort="inventory_name">Inventarliste</th>
            <th>Aktion</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr @if($product->trashed()) class="table-danger" @endif>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_number }}</td>
                <td>{{ $product->product_purchasePrice }}</td>
                <td>{{ $product->product_description }}</td>
                <td>
                    @foreach($product->categories as $category)
                        {{ $category->category_name }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>{{ $product->status->status_name }}</td>
                <td>{{$product->usage_start_date}}</td>
                <td>{{$product->usage_end_date}}</td>
                <td>{{$product->inventory->inventory_name}}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('products.edit', $product->id) }}">Bearbeiten</a>
                    @if(!$product->trashed())
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Löschen</button>
                        </form>
                    @else
                        <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-warning" type="submit">Wiederherstellen</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <label for="itemsPerPage">Produkte pro Seite:</label>
    <select id="itemsPerPage" name="itemsPerPage">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    {{$products->links()}}
</div>
