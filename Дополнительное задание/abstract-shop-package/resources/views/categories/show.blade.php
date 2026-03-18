@extends('abstract-shop::layouts.app')

@section('title', 'Категория')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Категория #{{ $item->id }}</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.categories.edit', $item) }}">Редактировать</a>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.categories.index') }}">Назад</a>
        </div>
    </div>

    <div class="card card-body bg-white">
        <div><span class="text-muted">Название:</span> {{ $item->name }}</div>
        <div><span class="text-muted">Parent ID:</span> {{ $item->parent_id ?? '—' }}</div>
    </div>
@endsection

