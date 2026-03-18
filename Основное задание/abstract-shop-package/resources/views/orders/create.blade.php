@extends('abstract-shop::layouts.app')

@section('title', 'Создать заказ')

@section('content')
    <h1 class="h3 mb-3">Создать заказ</h1>

    <form method="POST" action="{{ route('abstract-shop.orders.store') }}" class="card card-body bg-white">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Клиент</label>
                <select class="form-select" name="customer_id">
                    <option value="">—</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" @selected((string)old('customer_id') === (string)$c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Валюта</label>
                <input class="form-control" name="currency" value="{{ old('currency', 'RUB') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Адрес отправления (A)</label>
                <input class="form-control" name="from_address" value="{{ old('from_address') }}">
                <div class="form-text">Можно указать адрес или координаты `lat,lon`.</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Адрес доставки (B)</label>
                <input class="form-control" name="to_address" value="{{ old('to_address') }}">
            </div>
        </div>

        <div class="mb-2 fw-bold">Товары</div>
        @for($i=0; $i<3; $i++)
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Товар #{{ $i+1 }}</label>
                    <select class="form-select" name="items[{{ $i }}][product_id]" @if($i===0) required @endif>
                        <option value="">—</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}" @selected((string)old("items.$i.product_id") === (string)$p->id)>{{ $p->name }} ({{ $p->price }} {{ $p->currency }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Кол-во</label>
                    <input class="form-control" name="items[{{ $i }}][qty]" value="{{ old("items.$i.qty", $i===0 ? 1 : '') }}" @if($i===0) required @endif>
                </div>
            </div>
        @endfor

        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Создать</button>
            <a class="btn btn-outline-secondary" href="{{ route('abstract-shop.orders.index') }}">Назад</a>
        </div>
    </form>
@endsection

