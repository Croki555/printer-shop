<x-app-layout title="Корзина">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="pt-3">
            <div class="container-xxl">
                @if(count($products) == 0)
                    <h2>Корзина пуста</h2>
                    <a href="{{ route('catalog') }}">Перейти в каталог</a>
                @else
                    <h2>Корзина</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                        </thead>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach($products as $product)
                            @php
                                $allPrice = $product->price * $product->quantity;
                                $totalPrice += $allPrice;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <form action="{{ route('basket.edit', ['product_id' => $product->product_id ]) }}" method="post">
                                        @csrf
                                        <input type="number" class="form-control w-auto" name="edit_{{ $product->product_id }}" value="{{ old("edit_$product->product_id") ?? $product->quantity }}">
                                    </form>
                                    @error("basket_$product->product_id")
                                    <span class="d-block my-1 text-danger">{{ $message }}</span>
                                    @enderror
                                    @error("edit_$product->product_id")
                                    <span class="d-block my-1 text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>{{ $allPrice  }}</td>
                                <td>
                                    <form method="post" action="{{ route('basket.delete', ['product_id' => $product->product_id ]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link link-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="text-end">Итого:</th>
                            <th>{{ $totalPrice }}</th>
                        </tr>
                    </table>
                    <a href="{{ route('basket.checkout') }}" class="btn btn-success">Оформить заказ</a>
                @endif
                <x-slot name="scripts">
                    <script>
                        $(document).ready(function () {
                            $('input[type="number"]').on('change', function () {
                                $(this).parent('form').submit()
                            })
                        })
                    </script>
                </x-slot>
            </div>
        </section>
    @endsection
</x-app-layout>
