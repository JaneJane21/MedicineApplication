@extends('layout.app')
@section('title')
Авторизация
@endsection
@section('content')
<div class="container" id="Auth">
    <div class="mt-5" :class="message?'alert alert-danger':''">
    @{{ message }}</div>
    <div class="row mt-5 justify-content-center">
        <div class="col-5 d-flex flex-column align-items-center">
            <img style="width: 150px;" class="mb-4" src="{{ asset('public/logo/logo-sign.svg') }}">
            <form id="auth-form" @submit.prevent="auth()" method="post">
                <h1 class="bold">Авторизация</h1>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" name="login" id="login" :class="errors.login?'is_invalid':''">
                    <div v-for="error in errors.login" class="invalid-feedback d-block">
                        @{{ error }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" :class="errors.password?'is_invalid':''">
                    <div v-for="error in errors.password" class="invalid-feedback d-block">
                        @{{ error }}
                    </div>
                </div>
                <button type="submit" style="background-color: #B23850; color:white; width: 100%;" class="btn bold">Войти</button>
            </form>
        </div>
    </div>
</div>
<script>
    const app = {
        data(){
            return{
                message:'',
                errors:[]
            }
        },
        methods:{
            async auth(){
                let form = document.getElementById('auth-form')
                let form_data = new FormData(form)
                const response = await fetch('{{ route('auth') }}',{
                    method:'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    body:form_data
                })
                if(response.status == 200){
                    window.location = response.url
                }
                if(response.status == 404){
                    this.message = await response.json()
                    setTimeout(() => {
                        this.message = ''
                    }, 2000);
                }
                if(response.status == 400){
                    this.errors = await response.json()
                    setTimeout(() => {
                        this.errors = []
                    }, 2000);
                }
            }
        }
    }
    Vue.createApp(app).mount('#Auth')
</script>
@endsection
