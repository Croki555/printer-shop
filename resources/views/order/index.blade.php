<x-app-layout title="Мои заказы">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="py-5">
            <div class="container-xxl">
                @if(count($orders) == 0)
                    <h2>У вас нет заказов</h2>
                    <a href="{{ route('catalog') }}">Перейти в каталог</a>
                @else
                    <table class="table table-striped w-50">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Товары</th>
                            <th scope="col">Кол-во</th>
                            <th scope="col">Статус</th>
                        </tr>
                        </thead>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($orders as $order)
                            @php
                                $count = 0;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @foreach(json_decode($order->products) as $product)
                                        @php
                                        $count+= $product->quantity;
                                        $title = \Illuminate\Support\Facades\DB::table('products')->find($product->id);
                                        @endphp
                                        <a href="{{ route('product', ['id' => $product->id]) }}">{{ $title->title }}</a>
                                    @endforeach
                                </td>
                                <td>{{ $count }}</td>
                                <td>{{ $order->status->title  }}</td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Итого:</th>
                                <th>{{ $order->total_price }}</th>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </section>
    @endsection
</x-app-layout>
