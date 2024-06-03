@extends('layout.app')
@section('title')
Об улуге
@endsection
@section('content')
<div class="container">
    <div class="row" style="margin-top: 100px;">
        <div class="col-auto">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">{{ $service->title }}</h2>
        </div>
    </div>
        <div class="row align-items-start justify-content-between">
            <div class="col-6">
                <img style="width: 100%;" src="{{ '/public'.$service->img }}">
            </div>
            <div class="col-6">
                <p>{{ $service->description }}</p>
                <div class="mt-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <p style="color: #3B8BEB;">НАПРАВЛЕНИЕ: {{ mb_strtoupper($service->category->title) }}</p>
                        </div>
                        <div class="col-auto">
                            <p class="bold" style="padding: 9px 40px; color: white; background-color:#3B8BEB; border-radius:10px;">{{ $service->price }} руб.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="margin-top: 80px;">
            <div class="col-auto">
                <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Специалисты этой услуги</h2>
            </div>
        </div>
        <div class="row mb-5">
            @foreach ($specialists as $spec)
            <div class="card p-3 m-2 d-flex flex-column align-items-center justify-content-between" style="width: 15rem; box-shadow: 0px 2px 5px rgba(2, 2, 2, 0.466);">
                <img class="mb-2" style="width:76px; height: 76px; border-radius:50%; object-fit:cover;" src="{{ '/public/'.$spec->img }}">
                <p class="text-center">{{ $spec->fio }}</p>
                <b style="color: #3B8BEB;">{{ $spec->job }}</b>
            </div>
            @endforeach

        </div>
</div>
@endsection
