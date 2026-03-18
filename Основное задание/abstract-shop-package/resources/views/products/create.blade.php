@extends('abstract-shop::layouts.app')

@section('title', 'Создать товар')

@section('content')
    <h1 class="h3 mb-3">Создать товар</h1>

    <form method="POST" action="{{ route('abstract-shop.products.store') }}" class="card card-body bg-white">
        @csrf
        @include('abstract-shop::products._form', ['item' => null])
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.products.index') }}">Назад</a>
        </div>
    </form>
@endsection

