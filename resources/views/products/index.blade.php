<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Produkte') }}
            </h2>
        </x-slot>
    @if($products->isEmpty())
        <p>Keine Produkte verfügbar.</p>
    @else
        @include('components/filter')
        @include('products/table')
    @endif

    {{--sortieren mit JS--}}
    <script>
        $(document).ready(function(){
            $('th[data-sort]').on('click', function(){
                var table = $(this).parents('table').eq(0);
                var rows = table.find('tbody tr').toArray().sort(comparer($(this).index()));
                this.asc = !this.asc;
                if (!this.asc){rows = rows.reverse();}
                for (var i = 0; i < rows.length; i++){table.append(rows[i]);}
            });

            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index), valB = getCellValue(b, index);
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
                };
            }

            function getCellValue(row, index){ return $(row).children('td').eq(index).text(); }
        });

            document.addEventListener('DOMContentLoaded', function () {

                document.getElementById('filterForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const queryString = new URLSearchParams(formData).toString();

                    window.location.href = `{{ route('products.index') }}?${queryString}`;
                });
            });
        </script>

</x-app-layout>
{{--@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush--}}
