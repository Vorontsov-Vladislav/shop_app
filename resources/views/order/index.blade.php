@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Список заказов</h2>

    <a href="{{ route('order.create') }}" class="btn btn-success mb-3">Добавить заказ</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Дата</th>
                <th>ФИО покупателя</th>
                <th>Статус</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->total_price, 2, ',', ' ') }} руб.</td>
                    <td>
                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        @if($order->status === 'новый')
                            <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Отметить выполненным</button>
                            </form>
                        @endif
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить заказ?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection