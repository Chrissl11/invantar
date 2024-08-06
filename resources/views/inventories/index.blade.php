<x-app-layout>
    @include('components/success_message')
    @include('components/error_message')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventarlisten') }}
        </h2>
    </x-slot>
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <div class="field">
            <label class="label">Neue Inventarliste erstellen</label>
            <div class="control">
                <input class="input" type="text" value="{{old('inventory_name')}}" required name="inventory_name" >
            </div>
        </div>
        <div class="control">
            <button class="btn btn-success" type="submit">Erstellen</button>
        </div>
    </form>
    <table class="table is-fullwidth table-primary">
        <thead>
        <tr>
            <th>ID</th>
            <th>Inventar Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventories as $inventory)
            <tr>
                <td>
                    <a href="{{ route('inventories.show', $inventory->id) }}">
                        {{ $inventory->id }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('inventories.show', $inventory->id) }}">
                        {{ $inventory->inventory_name }}
                    </a>
                </td>
                <td>
                    <div class="buttons">
                        <a class="btn btn-sm btn-primary" href="{{ route('inventories.edit', $inventory->id) }}">Bearbeiten</a>
                        <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST"
                               style="display: inline-block;" onsubmit="return confirm('Sind Sie sicher, dass Sie dieses Inventar löschen möchten?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Löschen</button>
                        </form>
                </td>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if ($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
