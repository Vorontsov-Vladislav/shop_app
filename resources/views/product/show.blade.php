@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Просмотр товара</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $product->name }}</h4>
            <p class="card-text"><strong>Категория:</strong> {{ $product->category->name }}</p>
            <p class="card-text"><strong>Описание:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} руб.</p>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Назад</a>
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Редактировать</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
            </form>
        </div>
    </div>
</div>
@endsection