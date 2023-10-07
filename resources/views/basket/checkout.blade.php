<x-app-layout title="Оформление заказа">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="pt-3">
            <div class="container-xxl">
                <h2>Оформление заказа</h2>
                <table class="table table-sm table-light w-50">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col">Стоимость</th>
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
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $allPrice  }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-end">Итого:</th>
                        <th>{{ $totalPrice }}</th>
                    </tr>
                </table>
                <form action="{{ route('basket.booking') }}" class="d-flex flex-column gap-2" method="post">
                    @csrf
                    <div>
                        <label for="password">Для оформления заказа необходим пароль пользователя</label>
                        <input type="password" class="form-control w-25 @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success" value="Сформировать заказ">
                    </div>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
