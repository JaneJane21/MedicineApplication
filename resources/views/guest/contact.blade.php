@extends('layout.app')
@section('title')
Контакты
@endsection
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-auto">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Контакты</h2>
        </div>
    </div>
    <div class="row mt-5 mb-5 justify-content-between">
        <div class="col-4">
            <div class="mb-4">
                <div class="d-flex align-items-center">
                    <div class="" style="background-color: #3B8BEB; width: 13px; height: 13px; border-radius:50%; margin-right:30px;"></div>
                    <p style="margin-bottom: 0;">г. Нижний Новгород, ул. Горького, 17</p>
                </div>
                <div style="margin-left:40px;" class="d-flex">
                    <p >пн-пт 8:00-22:00<br>
                        сб 8:00-19:00<br>
                        вс 9:00-19:00</p>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex align-items-center">
                    <div class="" style="background-color: #3B8BEB; width: 13px; height: 13px; border-radius:50%; margin-right:30px;"></div>
                    <p style="margin-bottom: 0;">г. Нижний Новгород, ул. Ленина, 33</p>
                </div>
                <div style="margin-left:40px;" class="d-flex">
                    <p >пн-пт 8:00-22:00<br>
                        сб 8:00-19:00<br>
                        вс 9:00-19:00</p>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex align-items-center">
                    <div class="" style="background-color: #3B8BEB; width: 13px; height: 13px; border-radius:50%; margin-right:30px;"></div>
                    <p style="margin-bottom: 0;">г. Нижний Новгород, ул. Минина, 8</p>
                </div>
                <div style="margin-left:40px;" class="d-flex">
                    <p >пн-пт 8:00-22:00<br>
                        сб 8:00-19:00<br>
                        вс 9:00-19:00</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <iframe src="https://yandex.com/map-widget/v1/?um=constructor%3A2e041ff10176d00e590286b63e2d4d7ba94a03a1a6e735775e18548d7eaffe57&amp;source=constructor" width="599" height="480" frameborder="0"></iframe>
        </div>
    </div>
</div>
@endsection
