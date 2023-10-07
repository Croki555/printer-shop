<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
       <div class="container-xxl">
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbar">
               <ul class="navbar-nav me-md-auto">
                   <li class="nav-item">
                       <a class="nav-link" href="{{ route('home') }}#about">О нас</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="#">Где нас найти?</a>
                   </li>
                   @auth('web')
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('basket') }}">Корзина</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="{{ route('orders') }}">Мои заказы</a>
                       </li>
                       <li class="nav-item">
                           <form method="post">
                               @csrf
                               <a class="nav-link" href="{{ route('logout') }}" onclick="this.closest('form').submit()">Выйти</a>
                           </form>
                       </li>
                   @endauth
               </ul>
               @guest('web')
                   <div class="d-flex flex-md-row column-gap-3">
                       <a class="btn btn-primary col-md-auto w-auto" href="{{ route('login') }}">Войти</a>
                       <a class="btn btn-primary col-md-auto w-auto" href="{{ route('register') }}">Регистрация</a>
                   </div>
               @endguest
           </div>
       </div>
    </nav>
</header>
