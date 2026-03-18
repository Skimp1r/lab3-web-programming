@extends('abstract-shop::layouts.app')

@section('title', 'Товар')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Товар #{{ $item->id }}</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.products.edit', $item) }}">Редактировать</a>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.products.index') }}">Назад</a>
        </div>
    </div>

    <div class="card card-body bg-white">
        <div><span class="text-muted">Название:</span> {{ $item->name }}</div>
        <div><span class="text-muted">SKU:</span> {{ $item->sku }}</div>
        <div><span class="text-muted">Цена:</span> {{ $item->price }} {{ $item->currency }}</div>
        <div><span class="text-muted">Остаток:</span> {{ $item->stock }}</div>
        <div class="mt-2"><span class="text-muted">Описание:</span><br>{{ $item->description ?? '—' }}</div>
    </div>
@endsection

