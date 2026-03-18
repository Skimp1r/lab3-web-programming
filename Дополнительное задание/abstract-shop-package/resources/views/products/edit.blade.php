@extends('abstract-shop::layouts.app')

@section('title', 'Редактировать товар')

@section('content')
    <h1 class="h3 mb-3">Редактировать товар #{{ $item->id }}</h1>

    <form method="POST" action="{{ route('abstract-shop.products.update', $item) }}" class="card card-body bg-white">
        @csrf @method('PUT')
        @include('abstract-shop::products._form')
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.products.index') }}">Назад</a>
        </div>
    </form>
@endsection

