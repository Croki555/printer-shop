<x-app-layout title="Товар">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="pt-5">
            <div class="container-xxl">
                <div class="mb-3">
                    <a href="{{ route('catalog') }}">Обратно в каталог</a>
                </div>
                <div class="card border-0">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img" src="{{ route('home') }}/images/printer/{{ $product->image }}" alt="{{ $product->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title">Название: {{ $product->title }}</h1>
                                <p class="card-text"><b>Категория:</b> {{ $product->category->title }}</p>
                                <p class="card-text"><b>Страна производитель:</b> {{ $product->country }}</p>
                                <p class="card-text"><b>Год выпуска:</b> {{ $product->year }}</p>
                                <p class="card-text">
                                    <b>Цена:</b> <span class="text-danger">₽ {{ $product->price }}</span>
                                </p>
                                @auth('web')
                                    <form action="{{ route('basket.add', ['product_id' => $product->id ]) }}" method="post">
                                        @csrf
                                        <input type="hidden"  name="basket_{{ $product->id }}">
                                        <button class="btn btn-primary" type="submit">В корзину</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
