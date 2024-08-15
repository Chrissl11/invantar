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
    @vite(['resources/js/Table_Sort.js', 'resources/js/Table_Paginate.js'])


</x-app-layout>
{{--@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush--}}
