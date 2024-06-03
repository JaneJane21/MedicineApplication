@extends('layout.app')
@section('title')
Категории
@endsection
@section('content')
<div class="container">
    <div class="row mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="row mt-5 align-items-center justify-content-between">
        <div class="col-auto">
            <h1>Категории услуг</h1>
        </div>
        <div class="col-auto">
            <button data-bs-toggle="modal" data-bs-target="#newCatModal" class="btn btn-outline-danger">+добавить</button>
            <!-- Modal -->
            <div class="modal fade" id="newCatModal" tabindex="-1" aria-labelledby="newCatModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                    <h1 class="modal-title fs-5 text-light" id="newCatModalLabel">Создание новой категории</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id=""  method="post" action="{{ route('save_category') }}">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label for="title" class="form-label">Название категории</label>
                                <input type="text" class="form-control" name="title" id="title">

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
                <th scope="col">Название</th>
                <th scope="col"></th>

              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key=>$category)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $category->title }}</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <a href="{{ route('destroy_category',['id'=>$category->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                  </svg>
                                </a>
                            </div>
                            <div class="col-6">
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#editCatModal_${{ $category->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                      </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="editCatModal_${{ $category->id }}" tabindex="-1" aria-labelledby="newCatModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                        <h1 class="modal-title fs-5 text-light" id="newCatModalLabel">Изменение категории {{ $category->title }}</h1>
                                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id=""  method="post" action="{{ route('edit_category',['id'=>$category->id]) }}">
                                                @csrf
                                                @method('post')
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Название категории</label>
                                                    <input type="text" value="{{ $category->title }}" class="form-control" name="title" id="title">

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
