@extends('abstract-shop::layouts.app')

@section('title', 'Товары')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Товары</h1>
        <a class="btn btn-primary" href="{{ route('abstract-shop.products.create') }}">Создать</a>
    </div>

    <table class="table table-striped table-hover bg-white">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>SKU</th>
            <th>Цена</th>
            <th>Остаток</th>
            <th class="text-end">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $x)
            <tr>
                <td>{{ $x->id }}</td>
                <td><a href="{{ route('abstract-shop.products.show', $x) }}">{{ $x->name }}</a></td>
                <td>{{ $x->sku }}</td>
                <td>{{ $x->price }} {{ $x->currency }}</td>
                <td>{{ $x->stock }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('abstract-shop.products.edit', $x) }}">Изм.</a>
                    <form class="d-inline" method="POST" action="{{ route('abstract-shop.products.destroy', $x) }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
@endsection

