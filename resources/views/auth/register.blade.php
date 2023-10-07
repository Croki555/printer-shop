<x-app-layout title="Регистрация">
    <x-slot name="header"></x-slot>
    @section('content')
        <section class="pt-5">
            <div class="container-xxl">
                <form action="{{ route('register.store') }}" method="post" class="m-auto" style="max-width: 350px;">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" placeholder="#" value="Павел" required
                               regex="^[А-Яа-яЁё0-9\-]+$"
                               title="обязательное поле, разрешенные символы (кириллица, пробел и тире)">
                        <label for="login">Имя</label>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span error="name" class="invalid-feedback"></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="surname" placeholder="#" value="Соколов" required
                               regex="^[А-Яа-яЁё\s\-]$"
                               title="обязательное поле, разрешенные символы (кириллица, пробел и тире">
                        <label for="login">Фамилия</label>
                        @error('surname')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span error="patronymic" class="invalid-feedback"></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="login" placeholder="#" value="Pavel" required
                               regex="^[A-Za-z0-9\-]$">
                        <label for="login">Логин</label>
                        <span error="login" class="invalid-feedback"></span>
                        @error('login')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" placeholder="#" value="sokolov.pavlik28@gmail.com"
                               required>
                        <label for="login">Почта</label>
                        <span error="email" class="invalid-feedback"></span>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" placeholder="#" value="123456" minlength="6"
                               required>
                        <label for="password">Пароль</label>
                        <span error="password" class="invalid-feedback"></span>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="#" required value="123456">
                        <label for="login">Подтверждение пароля</label>
                        <span error="password_confirmation" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label for="agree" class="form-check-label">Согласие с правилами регистрации</label>
                        <input type="checkbox" class="form-check-input" name="agree" required checked>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Зарегистрироваться">
                </form>
            </div>
        </section>
    @endsection
{{--    <x-slot name="scripts">--}}
{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                let token = $('input[name="_token"]').val();--}}
{{--                $('input[type="text"]').blur(function () {--}}
{{--                    let regex = new RegExp($(this).attr('regex'));--}}
{{--                    let span = $(`span[error=${$(this).attr('name')}]`);--}}

{{--                    $(this).removeAttr('is-invalid').removeClass('is-invalid').addClass('is-valid')--}}
{{--                    if (!regex.test($(this).val())) {--}}
{{--                        $(this).attr('is-invalid', '').addClass('is-invalid')--}}
{{--                        span.html($(this).attr('title'))--}}
{{--                    }--}}
{{--                })--}}
{{--                $('input[name="login"]').blur(function () {--}}
{{--                    let span = $(`span[error=${$(this).attr('name')}]`);--}}
{{--                    $.ajax({--}}
{{--                            url: 'http://laravel/register',--}}
{{--                            method: 'POST',--}}

{{--                            date: {--}}
{{--                                '_token': token.val(),--}}
{{--                                'login': $(this).val()--}}
{{--                            },--}}
{{--                            error: function (data) {--}}
{{--                                if(data.status === 200) {--}}
{{--                                    $--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    )--}}
{{--                })--}}
{{--            })--}}
{{--        </script>--}}
{{--    </x-slot>--}}
</x-app-layout>
