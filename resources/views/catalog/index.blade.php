<x-app-layout title="Каталог">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="py-5">
            <div class="container-xxl">
                <div class="mb-3">
                    <form method="get" class="d-flex flex-column flex-lg-row justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="" class="form-label mb-0">Фильтрация:</label>
                            <select name="category" id="" class="form-select w-auto">
                                <option selected disabled>Виды принтера</option>
                                <option value="0"  @if($category == 0) selected @endif>Все</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}" @if($category == $item->id) selected @endif>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label for="sort" class="form-label mb-0">Сортировка:</label>
                            <form method="get" class="sortForm">
                                <select name="sort" id="" class="form-select w-auto">
                                    <option value="new" @if($sort == 'new') selected @endif>Новые</option>
                                    <option value="old"  @if($sort == 'old') selected @endif>Старые</option>
                                    <option value="priceUp"  @if($sort == 'priceUp') selected @endif>Цены по возрастанию</option>
                                    <option value="priceDown"  @if($sort == 'priceDown') selected @endif>Цены по убыванию</option>
                                </select>
                            </form>
                        </div>
                    </form>
                </div>
                <x-slot name="scripts">
                    <script>
                        $(document).ready(function () {
                            $('select[name="category"]').on('change', function () {
                                $('form').submit()
                            })
                            $('select[name="sort"]').on('change', function () {
                                $('form').submit()
                            })
                        })
                    </script>
                </x-slot>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
                    @foreach($products as $product)
                        @if($product->amount > 0)
                            <div class="col">
                                <div class="card p-2">
                                    <div class="text-center position-relative">
                                        <a href="{{ route('product', ['id'=> $product->id]) }}" class="stretched-link"></a>
                                        <img class="bd-placeholder-img object-fit-cover w-75 h-75" src="{{ route('home') }}/images/printer/{{ $product->image }}" alt="{{ $product->title }}">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $product->title }}</h3>
                                        <p class="card-text">{{ $product->category->title }}</p>
                                        <span>В наличии: {{ $product->amount }}</span>
                                        @error("basket_$product->id")
                                        <span class="d-block my-1 text-danger">{{ $message }}</span>
                                        @enderror
                                        <hr>
                                        <div class="d-flex justify-content-between h4 align-items-center">
                                            <span class="text-danger d-block my-2">₽ {{ $product->price }}</span>
                                            @auth('web')
                                                <form action="{{ route('basket.add', ['product_id' => $product->id ]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden"  name="basket_{{ $product->id }}">
                                                    <button class="border-0 bg-transparent" type="submit">🗑️</button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="py-2">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
