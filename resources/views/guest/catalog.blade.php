@extends('layout.app')
@section('title')
Все услуги
@endsection
@section('content')
<div class="container" id="Catalog">
    <div class="row mt-5">
        <div class="col-auto">
            <h2 class="mb-4" style="border-left: 3px solid #B23850; padding-left:12px;">Услуги</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-3 d-flex flex-column">
            <div class="mb-3">
                <label class="form-label" for="sorting">сортировать</label>
                <select class="form-control" id="sorting" v-model="sort" @change="sortService">
                    <option></option>
                    <option value="tomin">по возрастанию цены</option>
                    <option value="tomax">по убыванию цены</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="filtering">выбрать категорию</label>
                <select class="form-control" id="filtering" v-model="filter" @change="filterService">
                    <option disabled value=" "></option>
                    <option v-for="cat in categories" :value="cat.id">@{{ cat.title }}</option>

                </select>
            </div>
        </div>
        <div class="col-9 d-flex justify-content-center">
            <a :href="`{{ route('detail') }}/${s.id}`" v-for="s in sortService" class="card m-3" style="width: 15rem; box-shadow: 0px 2px 5px rgba(2, 2, 2, 0.466);">
                <img :src="`/public/${s.img}`" style="height: 160px; object-fit: cover;" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title">@{{ s.title }}</h5>
                        <b class="card-text">@{{ s.price }} руб.</b>
                    </div>
                  <p style="color: #3B8BEB; margin-bottom:0;">@{{  (s.category.title).toUpperCase() }}</p>
                </div>
              </a>
        </div>
    </div>
</div>
<script>

        window.link_filter = @json($link_filter);


    const app = {
        data(){
            return{
                sort: '',
                filter:'',
                sortParam:'price',

                services:[],
                categories:[],

            }
        },
        methods:{
            async getData(){
                const response_services = await fetch('{{ route('get_services') }}')
                this.services = await response_services.json()
                console.log(this.services)

                const response_categories = await fetch('{{ route('get_categories') }}')
                this.categories = await response_categories.json()
            }
        },
        computed:{
            filterService(){
                if(this.filter != ''){
                    return [...this.services].filter(s => s.category_id == this.filter)
                }
                else{
                    return this.services
                }
            },
            sortService(){

                if(this.sort == 'tomin'){

                    return this.filterService.sort((a,b) => (a.price - b.price))
                }
                else if(this.sort == 'tomax'){

                    return (this.filterService.sort((a,b) => (a.price - b.price))).reverse()
                }
                else{
                    return this.filterService
                }
            }
        },
        mounted(){
            this.filter = window.link_filter || '';
            this.getData()
        }
    }
    Vue.createApp(app).mount('#Catalog')
</script>
<style>
    a{
        text-decoration: none;
    }
</style>
@endsection
