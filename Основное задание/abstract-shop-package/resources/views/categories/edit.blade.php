@extends('abstract-shop::layouts.app')

@section('title', 'Редактировать категорию')

@section('content')
    <h1 class="h3 mb-3">Редактировать категорию #{{ $item->id }}</h1>

    <form method="POST" action="{{ route('abstract-shop.categories.update', $item) }}" class="card card-body bg-white">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input class="form-control" name="name" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parent ID (опционально)</label>
            <input class="form-control" name="parent_id" value="{{ old('parent_id', $item->parent_id) }}">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.categories.index') }}">Назад</a>
        </div>
    </form>
@endsection

