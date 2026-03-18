@extends('abstract-shop::layouts.app')

@section('title', 'Заказ')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Заказ #{{ $item->id }}</h1>
        <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.orders.index') }}">Назад</a>
    </div>

    <div class="card card-body bg-white mb-3">
        <div><span class="text-muted">Статус:</span> {{ $item->status }}</div>
        <div><span class="text-muted">Сумма:</span> {{ $item->total }} {{ $item->currency }}</div>
        <div><span class="text-muted">A:</span> {{ $item->from_address ?? '—' }}</div>
        <div><span class="text-muted">B:</span> {{ $item->to_address ?? '—' }}</div>
        <div><span class="text-muted">Дистанция:</span> {{ $item->delivery_distance_km ?? '—' }} км</div>
        <div><span class="text-muted">Доставка:</span> {{ $item->delivery_price ?? '—' }}</div>
    </div>

    <h2 class="h5">Позиции заказа</h2>
    <table class="table table-striped table-hover bg-white">
        <thead>
        <tr>
            <th>Товар</th>
            <th class="text-end">Цена</th>
            <th class="text-end">Кол-во</th>
            <th class="text-end">Сумма</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $x)
            <tr>
                <td>{{ $x->product_name }}</td>
                <td class="text-end">{{ $x->price }}</td>
                <td class="text-end">{{ $x->qty }}</td>
                <td class="text-end">{{ $x->line_total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

