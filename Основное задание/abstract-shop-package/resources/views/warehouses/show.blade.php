@extends('abstract-shop::layouts.app')

@section('title', 'Склад')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Склад #{{ $item->id }}</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.warehouses.edit', $item) }}">Редактировать</a>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.warehouses.index') }}">Назад</a>
        </div>
    </div>

    <div class="card card-body bg-white">
        <div><span class="text-muted">Название:</span> {{ $item->name }}</div>
        <div><span class="text-muted">Адрес:</span> {{ $item->address ?? '—' }}</div>
    </div>
@endsection

