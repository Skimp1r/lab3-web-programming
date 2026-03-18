@extends('abstract-shop::layouts.app')

@section('title', 'Редактировать клиента')

@section('content')
    <h1 class="h3 mb-3">Редактировать клиента #{{ $item->id }}</h1>

    <form method="POST" action="{{ route('abstract-shop.customers.update', $item) }}" class="card card-body bg-white">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input class="form-control" name="name" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" value="{{ old('email', $item->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input class="form-control" name="phone" value="{{ old('phone', $item->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Адрес</label>
            <input class="form-control" name="address" value="{{ old('address', $item->address) }}">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.customers.index') }}">Назад</a>
        </div>
    </form>
@endsection

