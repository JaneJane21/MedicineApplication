@extends('layout.app')
@section('title')
PROmed
@endsection
@section('content')
<div class="container">
    <div class="row align-items-center justify-content-between" id="about_us" style="margin-top: 100px;">
        <div class="col-5">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">О нас</h2>
            <p style="text-align: justify">
                Добро пожаловать в PROmed - ваш надежный партнер в области здоровья и благополучия. Наша клиника представляет собой современный медицинский центр, где каждый пациент получает высококачественную медицинскую помощь, сочетающую в себе инновационные технологии, профессионализм врачей и индивидуальный подход.
                Мы гордимся нашей командой высококвалифицированных специалистов, которые постоянно  следят за последними достижениями в медицине, чтобы предложить вам самые эффективные методы лечения и диагностики.
            </p>
            <p style="text-align: justify">
                Выбирая PROmed, вы выбираете заботу о своем здоровье на высшем уровне. Мы приглашаем вас присоединиться к нашему растущему числу довольных пациентов и узнать разницу в качестве обслуживания и ухода, которые мы предлагаем.
            </p>
            <p>
                С уважением, Команда PROmed
            </p>
        </div>
        <div class="col-auto">
            <img src="{{ asset('public/images/welcome-office.png') }}">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Наши преимущества</h2>
        </div>
        <div class="col-12">
            <div class="row justify-content-around">
                <div class="col-3 d-flex flex-column p-4 align-items-center justify-content-start" style="border: 5px solid #3B8BEB; border-radius: 30px; box-shadow: 0px 5px 5px rgba(2, 2, 2, 0.466);">
                    <img style="width: 60px; margin-bottom: 20px;" src="{{ asset('public/images/Gears.svg') }}">
                    <p style="font-size: 14px;" class="text-center">
                        <b class="">Инновационные технологии</b><br>
                        PROmed оборудована современным медицинским оборудованием, что позволяет проводить сложные процедуры и диагностику на высоком уровне
                    </p>
                </div>

                <div class="col-3 d-flex flex-column p-4 align-items-center justify-content-start" style="border: 5px solid #B23850; border-radius: 30px; box-shadow: 0px 5px 5px rgba(2, 2, 2, 0.466);">
                    <img style="width: 60px; margin-bottom: 20px;" src="{{ asset('public/images/Medical Doctor.svg') }}">
                    <p style="font-size: 14px;" class="text-center">
                        <b>Профессионализм врачей</b><br>
                        Каждый специалист в PROmed обладает высокой квалификацией и регулярно повышает свой профессиональный уровень, следуя мировым медицинским стандартам
                    </p>
                </div>

                <div class="col-3 d-flex flex-column p-4 align-items-center justify-content-start" style="border: 5px solid #3B8BEB; border-radius: 30px; box-shadow: 0px 5px 5px rgba(2, 2, 2, 0.466);">
                    <img style="width: 60px; margin-bottom: 20px;" src="{{ asset('public/images/Love.svg') }}">
                    <p style="font-size: 14px;" class="text-center">
                        <b>Индивидуальный подход</b><br>
                        Мы уделяем особое внимание установлению доверительных отношений с каждым пациентом, разрабатывая персонализированные планы лечения
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 ">
        <div class="col-12">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Наши специалисты</h2>
        </div>

    </div>
    <div class="row mb-5 justify-content-start">
       @foreach ($specialists as $spec)
            <div class="row m-2 p-1 align-items-center" style="width: 25rem; box-shadow: 0px 2px 5px rgba(2, 2, 2, 0.466); border-radius:10px;">
                <div class="col-auto">
                    <img class="mr-2" style="width:100px; height: 100px; border-radius:50%; object-fit:cover;" src="{{ '/public/'.$spec->img }}">
                </div>
                <div class="col-auto">
                    <p class="text-center">{{ $spec->fio }}</p>
                    <b style="color: #3B8BEB;">{{ $spec->job }}</b>
                </div>

            </div>
        @endforeach
    </div>
</div>
@endsection
