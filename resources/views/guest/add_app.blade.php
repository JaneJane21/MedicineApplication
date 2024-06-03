@extends('layout.app')
@section('title')
Заявка на звонок
@endsection
@section('content')
<div class="container pt-5" id="Application">
    <div id="start-block">
        <div class="row">
            <div class="col-auto">
                <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Заявка</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <form class="col-6" id="app-form" @submit.prevent="send_data()" method="post">
                <div class="mb-3">
                    <label for="fio" class="form-label">ФИО</label>
                    <input type="text" class="form-control" name="fio" id="fio" :class="errors.fio?'is_invalid':''">
                    <div v-for="error in errors.fio" class="invalid-feedback d-block">
                        @{{ error }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" name="phone" id="phone" :class="errors.phone?'is_invalid':''">
                    <div v-for="error in errors.phone" class="invalid-feedback d-block">
                        @{{ error }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Ваш запрос</label>
                    <textarea class="form-control" name="description" id="description" :class="errors.description?'is_invalid':''"></textarea>
                    <div v-for="error in errors.description" class="invalid-feedback d-block">
                        @{{ error }}
                    </div>
                </div>
                <button type="submit" style="background-color: #B23850; color:white; width: 100%;" class="btn bold">отправить</button>
            </form>
        </div>
    </div>
    <div id="finish-block" class="d-none">
        <h5 class="text-center">Ваша заявка отправлена, администратор свяжется с Вами в ближайшее время</h5>
    </div>

</div>
<script>
    const app = {
        data(){
            return{
                errors:[]
            }
        },
        methods:{
            async send_data(){
                let form = document.getElementById('app-form')
                let form_data = new FormData(form)
                const response = await fetch('{{ route('store_new_app') }}',{
                    method:'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    body:form_data
                })
                if(response.status == 400){
                    this.errors = await response.json()
                    setTimeout(() => {
                        this.errors = []
                    }, 2000);
                }
                if(response.status == 200){
                    let hide = document.getElementById('start-block')
                    let show = document.getElementById('finish-block')

                    hide.classList.add('d-none')
                    show.classList.remove('d-none')
                }
            }
        }
    }
    Vue.createApp(app).mount('#Application')
</script>
@endsection
