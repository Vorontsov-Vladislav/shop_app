@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Детали заказа</h2>

    <div class="card">
        <div class="card-body">
            <h4>ФИО: {{ $order->customer_name }}</h4>
            <p><strong>Товар:</strong> {{ $order->product->name }}</p>
            <p><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p><strong>Комментарий:</strong> {{ $order->comment ?? 'Нет' }}</p>
            <p><strong>Статус:</strong> {{ $order->status }}</p>
            <p><strong>Итоговая цена:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} руб.</p>
            <a href="{{ route('order.index') }}" class="btn btn-secondary">Назад</a>
            @if($order->status === 'новый')
                <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Отметить выполненным</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection