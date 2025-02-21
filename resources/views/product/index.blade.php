@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Список товаров</h2>
    <a href="{{ route('product.create') }}" class="btn btn-success mb-3">Добавить товар</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2, ',', ' ') }} руб.</td>
                    <td>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить товар?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection