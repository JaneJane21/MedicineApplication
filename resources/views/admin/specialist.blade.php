@extends('layout.app')
@section('title')
Специалисты
@endsection
@section('content')
<div class="container" id="Specialist">
    <div class="row mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="row mt-5 align-items-center justify-content-between">
        <div class="col-auto">
            <h1>Специалисты</h1>
        </div>
        <div class="col-auto">
            <button data-bs-toggle="modal" data-bs-target="#newSpecModal" class="btn btn-outline-danger">+добавить</button>
            <!-- Modal -->
            <div class="modal fade" id="newSpecModal" tabindex="-1" aria-labelledby="newSpecModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5 text-light" id="newSpecModalLabel">Добавление нового специалиста</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id=""  method="post" action="{{ route('save_specialist') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label for="fio" class="form-label">ФИО специалиста</label>
                                <input type="text" class="form-control" name="fio" id="fio">
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Фото специалиста</label>
                                <input type="file" class="form-control" name="img" id="img">
                            </div>

                            <div class="mb-3">
                                <label for="job" class="form-label">Специализация</label>
                                <input type="text" class="form-control" name="job" id="job">
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Категория услуги</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Оказываемая услуга</label>
                                <select name="service_id" id="service_id" class="form-control">
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" style="" class="btn btn-danger">сохранить</button>
                        </form>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Фото</th>
                <th scope="col">ФИО</th>
                <th scope="col">Специализация</th>
                <th scope="col">Категория услуг</th>
                <th scope="col">Услуга</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($specialists as $key=>$specialist)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><img style="width: 100px;" src="{{'public'.$specialist->img }}"></td>
                    <td>{{ $specialist->fio }}</td>

                    <td>{{ $specialist->job }}</td>
                    <td>{{ $specialist->category->title }}</td>
                    <td>{{ $specialist->service->title }}</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <a href="{{ route('destroy_specialist',['id'=>$specialist->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                  </svg>
                                </a>
                            </div>
                            <div class="col-6">
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#editspecialistModal_${{ $specialist->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                      </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="editspecialistModal_${{ $specialist->id }}" tabindex="-1" aria-labelledby="newspecialistModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                        <h1 class="modal-title fs-5 text-light" id="newspecialistModalLabel">Редактирование данных специалиста {{ $specialist->fio }}</h1>
                                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id=""  method="post" action="{{ route('edit_specialist',['id'=>$specialist->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <div class="mb-3">
                                                    <label for="fio" class="form-label">ФИО специалиста</label>
                                                    <input type="text" value="{{ $specialist->fio }}" class="form-control" name="fio" id="fio">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="img" class="form-label">Фото специалиста</label>
                                                    <input type="file" class="form-control" name="img" id="img">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="job" class="form-label">Специализация</label>
                                                    <input type="text" value="{{ $specialist->job }}" class="form-control" name="job" id="job">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Категория услуги</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="service_id" class="form-label">Оказываемая услуга</label>
                                                    <select name="service_id" id="service_id" class="form-control">
                                                        @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" style="" class="btn btn-danger">изменить</button>
                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                @endforeach

            </tbody>
          </table>
    </div>
</div>
@endsection
