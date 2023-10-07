<x-app-layout title="Главная">
    <x-slot name="header"></x-slot>
    @section('about')
        <section id="about">
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="dark">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach($products as $product)
                        <div class="carousel-item @if($loop->first) active @endif" style="height: 450px;">
                            <img class="bd-placeholder-img object-fit-contain w-100 h-100" src="images/printer/{{ $product->image }}" alt="{{ $product->title }}">
                            <div class="container">
                                <div class="carousel-caption">
                                    <h1 class="text-dark">{{ $product->title }}</h1>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    @endsection
    <x-slot name="scripts">
        <script src="js/bootstrap.bundle.min.js"></script>
    </x-slot>
</x-app-layout>
