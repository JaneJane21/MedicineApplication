@extends('layout.app')
@section('title')
Все специалисты
@endsection
@section('content')
<div class="container" id="Specialists">
    <div class="row mt-5">
        <div class="col-auto">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Специалисты</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-3 d-flex flex-column">

            <div class="mb-3">
                <label class="form-label" for="filtering">выбрать услугу</label>
                <select class="form-control" id="filtering" v-model="filter" @change="filterSpec">
                    <option disabled value=""></option>
                    <option v-for="serv in services" :value="serv.id">@{{ serv.title }}</option>

                </select>
            </div>
        </div>
        <div class="col-9">
            <div class="row justify-content-center">
              <div v-for="spec in filterSpec" class="p-3 m-2 d-flex flex-column align-items-center justify-content-between" style="width: 320px; box-shadow: 0px 2px 5px rgba(2, 2, 2, 0.466); border-radius:10px;">
                <img class="mb-2" style="width:76px; height: 76px; border-radius:50%; object-fit:cover;" :src="`public${spec.img}`">
                <p class="text-center">@{{ spec.fio }}</p>
                <b style="color: #3B8BEB;">@{{ spec.job }}</b>
            </div>
            </div>


        </div>
    </div>
</div>
<script>
    const app = {
        data(){
            return{

                filter:'',


                services:[],
                specialists: []

            }
        },
        methods:{
            async getData(){
                const response_services = await fetch('{{ route('get_services_for_spec') }}')
                this.services = await response_services.json()
                console.log(this.services)

                const response_specialists = await fetch('{{ route('get_specialists') }}')
                this.specialists = await response_specialists.json()
            }
        },
        computed:{
            filterSpec(){
                if(this.filter != ''){
                    return [...this.specialists].filter(s => s.service_id == this.filter)
                }
                else{
                    return this.specialists
                }
            }

        },
        mounted(){
            this.getData()
        }
    }
    Vue.createApp(app).mount('#Specialists')
</script>
<style>
    a{
        text-decoration: none;
    }
</style>
@endsection
