@extends('abstract-shop::layouts.app')

@section('title', 'Создать поставщика')

@section('content')
    <h1 class="h3 mb-3">Создать поставщика</h1>

    <form method="POST" action="{{ route('abstract-shop.suppliers.store') }}" class="card card-body bg-white">
        @csrf
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input class="form-control" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.suppliers.index') }}">Назад</a>
        </div>
    </form>
@endsection

