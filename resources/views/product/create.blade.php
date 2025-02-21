@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Добавить новый товар</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select name="category_id" id="category_id" class="form-control" >
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена (в рублях)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" >
        </div>

        <button type="submit" class="btn btn-success">Добавить товар</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection