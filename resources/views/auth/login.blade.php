<x-app-layout title="Авторизация">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="pt-5">
            <div class="container-xxl">
                <form action="{{ route('auntificate') }}" method="post" class="m-auto" style="max-width: 250px;">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" placeholder="#" value="Pavel">
                        <label for="login">Логин</label>
                        @error('login')
                        <span class="invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" placeholder="#" value="123456">
                        <label for="password">Пароль</label>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Войти">
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
