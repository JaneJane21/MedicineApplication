@extends('layout.app')
@section('title')
Все заявки
@endsection
@section('content')
<div class="container" id="Application">
    <div class="row mt-5">
        <div class="col-auto">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Все заявки</h2>
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <label class="form-label" for="filtering">Фильтр по статусу</label>
            <select class="form-control" id="filtering" v-model="filter" @change="filterApp">
                <option disabled value="">выбрать...</option>
                <option value="новая">новые</option>
                <option value="подтвержденная">подтвержденные</option>
                <option value="отмененная">отмененные</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div v-for="app in filterApp" class="col-12 mb-3 p-3" style="border-radius: 10px; border:1px solid #B23850;">
            <p>@{{ (app.created_at).slice(0,10) }} | @{{ app.fio }} | <span class="bold">@{{ app.phone }}</span></p>
            <p>статус: <span class="bold">@{{ app.status }}</span></p>
            <p>описание: @{{ app.description }}</p>
            <div v-if="app.status == 'новая'" class="d-flex justify-content-end">
                <button data-bs-toggle="modal" :data-bs-target="`#cancelModal_${app.id}`" class="btn btn-outline-danger m-1">отменить</button>
                <!-- Modal -->
                <div class="modal fade" :id="`cancelModal_${app.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Отмена заявки на имя @{{ app.fio }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form :id="`cancel_form_${app.id}`" @submit.prevent="cancel_app(app.id)" method="post">
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Причина отмены</label>
                                    <textarea  class="form-control" name="comment" id="comment" :class="errors.comment?'is_invalid':''"></textarea>
                                    <div v-for="error in errors.comment" class="invalid-feedback d-block">
                                        @{{ error }}
                                    </div>
                                </div>

                                <button type="submit" data-bs-dismiss="modal" style="background-color: #B23850; color:white; width: 100%;" class="btn bold">сохранить</button>
                            </form>
                        </div>

                    </div>
                    </div>
                </div>
                <button data-bs-toggle="modal" :data-bs-target="`#confirmModal_${app.id}`" class="btn btn-outline-danger m-1">подтвердить</button>
                <!-- Modal -->
                <div class="modal fade" :id="`confirmModal_${app.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение заявки на имя @{{ app.fio }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div :class="message?'alert alert-danger':''">
                            @{{ message }}
                            </div>
                            <form :id="`confirm_form_${app.id}`" @submit.prevent="confirm_app(app.id)" method="post">
                                <div class="mb-3">
                                    <label for="specialist_id" class="form-label">Врач</label>
                                    <select class="form-control" name="specialist_id" id="specialist_id" :class="errors.specialist_id?'is_invalid':''">
                                        <option v-for="spec in specialists" :value="spec.id">@{{ spec.fio }}</option>
                                    </select>
                                    <div v-for="error in errors.specialist_id" class="invalid-feedback d-block">
                                        @{{ error }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Дата сеанса</label>
                                    <input type="date" class="form-control" name="date" id="date" :class="errors.date?'is_invalid':''">
                                    <div v-for="error in errors.date" class="invalid-feedback d-block">
                                        @{{ error }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Время сеанса</label>
                                    <input type="time" class="form-control" name="time" id="time" :class="errors.time?'is_invalid':''">
                                    <div v-for="error in errors.time" class="invalid-feedback d-block">
                                        @{{ error }}
                                    </div>
                                </div>

                                <button type="submit" style="background-color: #B23850; color:white; width: 100%;" class="btn bold">сохранить</button>
                            </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const app = {
        data(){
            return{
                applications:[],
                specialists:[],
                filter:'',
                errors:[],
                message:''
            }
        },
        methods:{
            async getData(){
                const response_application = await fetch('{{ route('get_applications') }}');
                const response_specialists = await fetch('{{ route('get_specialists_for_app') }}');
                this.applications = await response_application.json()
                this.specialists = await response_specialists.json()
            },
            async cancel_app(id){
                let form = document.getElementById('cancel_form_'+id)
                let form_data = new FormData(form)
                form_data.append('id',id)
                const response = await fetch('{{ route('cancel_application') }}',{
                    method:'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    body:form_data
                })
                if(response.status == 200){
                    this.getData()
                }
                if(response.status == 400){
                    this.errors = await response.json()
                    setTimeout(() => {
                        this.errors = []
                    }, 2000);
                }
            },
            async confirm_app(id){
                let form = document.getElementById('confirm_form_'+id)
                let form_data = new FormData(form)
                form_data.append('id',id)
                const response = await fetch('{{ route('confirm_application') }}',{
                    method:'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    body:form_data
                })
                if(response.status == 200){
                    this.getData()
                }
                if(response.status == 400){
                    this.errors = await response.json()
                    setTimeout(() => {
                        this.errors = []
                    }, 2000);
                }
                if(response.status == 404){
                    this.message = await response.json()
                    setTimeout(() => {
                        this.message = ''
                    }, 5000);
                }
            }
        },
        computed:{
            filterApp(){
                if(this.filter != ''){
                    return [...this.applications].filter(s => s.status == this.filter)
                }
                else{
                    return this.applications
                }
            }

        },
        mounted(){
            this.getData()
        }
    }
Vue.createApp(app).mount('#Application')
</script>
@endsection
