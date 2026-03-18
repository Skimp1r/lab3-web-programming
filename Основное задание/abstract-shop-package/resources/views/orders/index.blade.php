@extends('abstract-shop::layouts.app')

@section('title', 'Заказы')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Заказы</h1>
        <a class="btn btn-primary" href="{{ route('abstract-shop.orders.create') }}">Создать</a>
    </div>

    <table class="table table-striped table-hover bg-white">
        <thead>
        <tr>
            <th>ID</th>
            <th>Статус</th>
            <th>Сумма</th>
            <th class="text-end">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $x)
            <tr>
                <td><a href="{{ route('abstract-shop.orders.show', $x) }}">#{{ $x->id }}</a></td>
                <td>{{ $x->status }}</td>
                <td>{{ $x->total }} {{ $x->currency }}</td>
                <td class="text-end">
                    <form class="d-inline" method="POST" action="{{ route('abstract-shop.orders.destroy', $x) }}">
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

