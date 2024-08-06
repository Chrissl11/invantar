<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produkt bearbeiten') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h3 class="h3 mb-4">Produkt "{{ $product->product_name }}" bearbeiten</h3>

        <form action="{{ route('products.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="productName" class="form-label">Produktname</label>
                <input type="text" class="form-control" id="productName" name="product_name" value="{{ $product->product_name }}" required>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="productNumber" class="form-label">Produktnummer</label>
                        <input type="text" class="form-control" id="productNumber" name="product_number" value="{{ $product->product_number }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="usageStartDate" class="form-label">Verwendungsbeginn (Pflichtfeld)</label>
                        <input type="date" class="form-control" id="usageStartDate" name="usage_start_date" value="{{ $product->usage_start_date }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="usageEndDate" class="form-label">Verwendungsende (Optional)</label>
                        <input type="date" class="form-control" id="usageEndDate" name="usage_end_date" value="{{ $product->usage_end_date }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="purchasePrice" class="form-label">Anschaffungspreis</label>
                        <input type="number" step="0.01" class="form-control" id="purchasePrice" name="product_purchasePrice" value="{{ $product->product_purchasePrice }}" required>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategorie</label>
                        <select id="category" name="category_id[]" class="form-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($product->categories->contains($category->id)) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status_id" class="form-select" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" @if($product->status_id == $status->id) selected @endif>{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="inventory" class="form-label">Inventarliste</label>
                        <select id="inventory" name="inventory_id" class="form-select" required>
                            <option value="" disabled selected>Wählen Sie eine Inventarliste</option>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}" @if($product->inventory_id == $inventory->id) selected @endif>{{ $inventory->inventory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="productDescription" class="form-label">Verwendung/Ort</label>
                <textarea id="productDescription" name="product_description" class="form-control" rows="3">{{ $product->product_description }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Produkt aktualisieren</button>
            </div>
        </form>
    </div>
</x-app-layout>
