<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
    <i class="bi bi-filter"></i> Filter
</button>

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Produkte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Produktname</label>
                        <input type="text" class="form-control" id="productName" name="product_name">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategorie</label>
                        <input type="text" class="form-control" id="category" name="category">
                    </div>

                    <div class="mb-3">
                        <label for="productNumber" class="form-label">Produktnummer</label>
                        <input type="text" class="form-control" id="productNumber" name="product_number">
                    </div>

                    <div class="mb-3">
                        <label for="purchasePrice" class="form-label">Anschaffungspreis</label>
                        <input type="number" step="0.01" class="form-control" id="purchasePrice" name="product_purchasePrice">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Verwendung/Ort</label>
                        <input type="text" class="form-control" id="description" name="product_description">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
                    </div>

                    <div class="mb-3">
                        <label for="usageStartDate" class="form-label">Verwendungsbeginn</label>
                        <input type="date" class="form-control" id="usageStartDate" name="usage_start_date">
                    </div>

                    <div class="mb-3">
                        <label for="usageEndDate" class="form-label">Verwendungsende</label>
                        <input type="date" class="form-control" id="usageEndDate" name="usage_end_date">
                    </div>

                    <div class="mb-3">
                        <label for="inventory" class="form-label">Inventarliste</label>
                        <input type="text" class="form-control" id="inventory" name="inventory">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="includeDeleted" name="include_deleted">
                            <label class="form-check-label" for="includeDeleted">Gelöschte Produkte einbeziehen</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Suchen</button>
                </form>
            </div>
        </div>
    </div>
</div>
