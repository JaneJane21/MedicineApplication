<nav class="navbar mt-4 navbar-expand-lg" id="Nav">
    <div class="container justify-content-between">
      <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('public\logo\logo.svg') }}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex justify-content-around w-100 align-items-center">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">главная</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              услуги
            </a>
            <ul class="dropdown-menu">
              <li v-for="serv in services"><a class="dropdown-item" :href="`{{ route('catalog_filter') }}/${serv.id}`">@{{ serv.title }}</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ route('catalog') }}">все услуги</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('specialists') }}">специалисты</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('contact') }}">контакты</a>
          </li>

          @guest
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('login') }}">войти</a>
            </li>

          @endguest
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              панель управления
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('category') }}">категории</a></li>
              <li><a class="dropdown-item" href="{{ route('service') }}">услуги</a></li>
              <li><a class="dropdown-item" href="{{ route('specialist') }}">специалисты</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ route('application') }}">заявки</a></li>
            </ul>
          </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('logout') }}">выход</a>
            </li>
          @endauth
          <li class="nav-item">
            <a href="{{ route('new_app') }}" class="" style="color: white; padding: 7px 14px; border-radius:10px; background-color:#B23850; text-decoration: none;" aria-current="page" href="{{ route('contact') }}">оформить заявку</a>
        </li>

        </ul>

      </div>
    </div>
  </nav>
  <script>
    const nav = {
        data(){
            return{
                services:[]
            }
        },
        methods:{
            async getData(){
                const response = await fetch('{{ route('get_nav_categories') }}')
                this.services = await response.json()
            }
        },
        mounted(){
            this.getData()
        }
    }
    Vue.createApp(nav).mount('#Nav')
  </script>
  <style>
    .nav-link{
        border-bottom: 2px solid #b2385000;
        padding-bottom: 5px;
        transition: 0.3s;
    }
    .nav-link:hover{
        /* padding-bottom: 10px; */
        transition: 0.3s;
        border-bottom: 2px solid #B23850;
    }
  </style>
