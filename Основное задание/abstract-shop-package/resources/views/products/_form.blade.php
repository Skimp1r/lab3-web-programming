@php($currencies = ['RUB','USD','EUR'])

<div class="mb-3">
    <label class="form-label">Название</label>
    <input class="form-control" name="name" value="{{ old('name', $item->name ?? '') }}" required>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">SKU</label>
        <input class="form-control" name="sku" value="{{ old('sku', $item->sku ?? '') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Цена</label>
        <input class="form-control" name="price" value="{{ old('price', $item->price ?? '0.00') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Валюта</label>
        <select class="form-select" name="currency">
            @foreach($currencies as $c)
                <option value="{{ $c }}" @selected(old('currency', $item->currency ?? 'RUB') === $c)>{{ $c }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Категория</label>
        <select class="form-select" name="category_id">
            <option value="">—</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected((string)old('category_id', $item->category_id ?? '') === (string)$c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Поставщик</label>
        <select class="form-select" name="supplier_id">
            <option value="">—</option>
            @foreach($suppliers as $s)
                <option value="{{ $s->id }}" @selected((string)old('supplier_id', $item->supplier_id ?? '') === (string)$s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Склад</label>
        <select class="form-select" name="warehouse_id">
            <option value="">—</option>
            @foreach($warehouses as $w)
                <option value="{{ $w->id }}" @selected((string)old('warehouse_id', $item->warehouse_id ?? '') === (string)$w->id)>{{ $w->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Остаток</label>
    <input class="form-control" name="stock" value="{{ old('stock', $item->stock ?? 0) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Описание</label>
    <textarea class="form-control" name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
</div>

