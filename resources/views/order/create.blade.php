@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Создание заказа</h2>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">ФИО покупателя</label>
            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required>
            @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Выберите товар</label>
            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ number_format($product->price, 2, ',', ' ') }} руб.)</option>
                @endforeach
            </select>
            @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Количество</label>
            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="1" min="1" required>
            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Комментарий</label>
            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
            @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Создать заказ</button>
        <a href="{{ route('order.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection