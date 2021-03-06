@extends('layouts.home')

@section('breadcrumbs')
    <a href="/">Главная</a> -&gt; Личный кабинет
@endsection

@section('home_content')
    @if (!$user->confirm)
        <div class="alert alert-danger">
            <strong>Внммннее!</strong>
            Подтвердиее Ваш <u>email</u> адрес!
        </div>
    @endif
    <div class="headervakanse" id="balance">
        <p style="font-size: 19px;">Баланс: <span style="color: orange;">{{ $user->balance }}</span> Seorik
            <button class="button-main">Пополнить</button>
        </p>
    </div>
    <div class="rezumeblock">
        <p class="editpersonal"><a onclick="enableEdit(this);">Редактировать</a></p>
        <div class="avatarvacanse">
            <img alt="Аватар {{ $user->name }}" title="Avatar" src="/{{ $user->image }}">
            {!! Form::open(['id' => 'input_file_form']) !!}
            {!! Form::file('image', [ 'class' => 'input_width hidden', 'required', 'id' => 'input_file']) !!}
            {!! Form::submit('Изменить', [ 'class' => 'input_width hidden']) !!}
            {!! Form::close() !!}
        </div>
        <h1>
            <span class="edittext">{{ $user->name }}</span>
            {!! Form::text('name', $user->name, [ 'class' => 'input_width hidden', 'required']) !!}
        </h1>

        <p>Тип:
            <span class="edittext">
                    @if ($company->agency)
                    Кадровое агенство
                @else
                    Прямой работодатель
                @endif
                </span>
            {!! Form::select('agency', $agency, $company->agency, [ 'class' => 'input_width hidden']) !!}
        </p>


        <p>Email:
            <span class="edittext">{{ $user->email }}</span>
            {!! Form::email('email', $user->email, [ 'class' => 'input_width hidden', 'required']) !!}
        </p>

        <p>Веб-сайт:
            <span class="edittext"><a href="{{ $company->website }}"> {{ $company->website }}</a></span>
            {!! Form::text('website', $company->website, [ 'class' => 'input_width hidden', 'required']) !!}
        </p>

        <h3>О компании: </h3>
        <p>
            <span class="edittext">{!! $company->description !!}</span>
            {!! Form::textarea('description', $company->description, [ 'class' => 'input_width hidden', 'required']) !!}
        </p>
        <p class="edsub">
            {!! Form::button('Сохранить', [ 'class' => 'input_width hidden', 'onclick' => 'updateInfo(this);']) !!}
            {!! Form::button('Не сохранять', [ 'class' => 'input_width btn-link hidden', 'onclick' => 'disableEdit(this);']) !!}
        </p>
    </div>
    <div class="two-big_button">
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <button class="button-main">Удалить аккаунт</button>
            </div>
        </div>
    </div>
    <script>
        function showNotificantion(response) {
            var status = JSON.parse(response);
            var msg = '<div class="alert alert-' + status["class"] + '" role="alert"><strong>' + status["message"] + '</strong></div>';
            $('.headervakanse#balance').after(msg);

            $(window).scrollTop($('.alert').offset().top);//speed?
        }

        function enableEdit(button) {
            var div = $(button).parent().parent();

            var inputs = div.find('.input_width').removeClass('hidden');
            var text = div.find('.edittext').addClass('hidden');
        }

        function disableEdit(button) {
            var div = $(button).parent().parent();

            var inputs = div.find('.input_width').addClass('hidden');
            var text = div.find('.edittext').removeClass('hidden');
        }

        function updateInfo(button) {
            var div = $(button).parent().parent();

            var name = div.find("input[name*='name']").val();
            var email = div.find("input[name*='email']").val();
            var website = div.find("input[name*='website']").val();
            var description = div.find("input[name*='description']").val();

            $.ajax({
                url: '{{ route("user.edit.info") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    email: email,
                    website: website,
                    description: description
                },
                success: function (data) {
                    showNotificantion(data);
                    disableEdit(button);
                    location.reload();//add timer 2 sec
                }
            })
        }


        $(document).ready(function (e) {
            $('#input_file_form').on('submit', (function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: 'POST',
                    url: '{{ route("user.edit.image") }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        showNotificantion(data);
                        location.reload();
                    }
                });
            }));

        });
    </script>
@endsection