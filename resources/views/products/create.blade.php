<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Neues Produkt hinzufügen') }}
            </h2>
        </x-slot>


        <div class="container mt-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <!-- Flexbox Container für nebeneinander liegende Formularelemente -->
                <div class="row g-3">
                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Produkt Name</label>
                            <input type="text" class="form-control" id="productName" name="product_name" placeholder="Produkt Name" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="productNumber" class="form-label">Produktnummer</label>
                            <input type="text" class="form-control" id="productNumber" name="product_number" placeholder="Produktnummer" value="{{ $nextProductId }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="usageStartDate" class="form-label">Verwendungsbeginn</label>
                            <input type="date" class="form-control" id="usageStartDate" name="usage_start_date" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="usageEndDate" class="form-label">Verwendungsende</label>
                            <input type="date" class="form-control" id="usageEndDate" name="usage_end_date">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="purchasePrice" class="form-label">Anschaffungspreis</label>
                            <input type="number" class="form-control" id="purchasePrice" name="product_purchasePrice" placeholder="Anschaffungspreis" required>
                        </div>
                    </div>
                </div>


        <div class="row g-3">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category" class="form-label">Kategorie</label>
                    <select id="category" name="category_id[]" class="form-select" multiple required>
                        <option value="" disabled selected>Wählen Sie eine Kategorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status_id" class="form-select" required>
                        <option value="" disabled selected>Wählen Sie einen Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
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
                            <option value="{{ $inventory->id }}">{{ $inventory->inventory_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-12">
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Verwendung/Ort</label>
                    <textarea id="productDescription" name="product_description" class="form-control" placeholder="Verwendung/Ort"></textarea>
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-success" type="submit">Hinzufügen</button>
            </div>
        </div>
        </form>
        </div>

</x-app-layout>
