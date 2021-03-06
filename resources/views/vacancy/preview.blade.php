<div class="container preview">
    <div id="preview" class="preview">
        <div class="block">
            <div class="row">
                <div class="col-xs-12">
                    <div class="menu_employer ">
                        <a href="#">
                            <div class="menushka">VIP-Статус</div>
                        </a>
                        <a href="#">
                            <div class="menushka selected_menu">Описание</div>
                        </a>
                        <a href="#">
                            <div class="menushka">Фото</div>
                        </a>
                        <a href="#">
                            <div class="menushka">Отзывы</div>
                        </a>
                    </div>
                    <div class="info_employer">
                        <h2 id="writte_main-name">{{ $vacancy->title }}</h2>
                        <div class="clearfix">
                            <div class="image_employer">
                                <img title="Имя Фамилия" alt="employer image" src="{{ $user->image }}">
                            </div>
                            <div class="how_find_employer">
                                <h5><strong>Связаться с автором обьявления:</strong></h5>
                                {{--<div class="info_o">--}}
                                    {{--<p id="writte_tel">+38063777743</p>--}}
                                    {{--<img src="/img/phone.png" title="Телефон" alt="phone">--}}
                                {{--</div>--}}
                                <div class="info_o">
                                    <p id="writte_pip">{{ $user->name }}</p>
                                    <img src="/img/man.png" title="Логотип человек" alt="phone">
                                </div>
                                <div class="info_o">
                                    <p>{{ $country }} - {{ $vacancy->city }}</p>
                                    <img src="/img/here.png" title="Страна" alt="phone">
                                </div>
                                <div class="info_o">
                                    <p id="writte_email">{{ $user->email }}</p>
                                    <img src="/img/mail.png" title="Логотип email" alt="phone">
                                </div>
                                <div class="info_o">
                                    <p>Категория {{ $category }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Спецыальность {{ $profession }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Зарплата от {{ $vacancy->salary }} {{ $currency }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Стаж: {{ $experience_type }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Тип образования: {{ $education_type }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Тип зайнятости: {{ $employment }}</p>
                                </div>
                                <div class="info_o">
                                    <p>Возраст от {{ $vacancy->age_min }} до {{ $vacancy->age_max }}</p>
                                </div>
                                <a href="">
                                    <div class="writte_to_employer">
                                        Написать автору
                                        <img title="Сообщение" src="img/w512h3361380476923mail.png" alt="writte_to_employer">
                                    </div>

                                </a>
                            </div>
                        </div>

                        <div class="text_employer">
                            <p id="text_written">
                                {!! $vacancy->description !!}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>