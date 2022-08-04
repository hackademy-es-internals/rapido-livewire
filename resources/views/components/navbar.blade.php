<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">Rapido.es</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">{{__('Quienes somos')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">{{__('Dónde estamos')}}</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{__('Categorías')}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="{{route('category.ads',$category)}}">{{__($category->name)}}</a></li>
            @endforeach
          </ul>
        </li>
        @guest
        @if (Route::has('login'))
        <li class="nav-item ">
          <a class="nav-link"
          href="{{route('login')}}"><span>{{__('Entrar')}}</span></a>
        </li>
        @endif    
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link"
          href="{{route('register')}}"><span>{{__('Registrar')}}</span></a>
        </li>
        @endif
        @else
        <li class="nav-item">
          <a class="nav-link btn btn-info" href="{{ route('ads.create') }}">
            {{__('Nuevo Anuncio')}}
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if (Auth::user()->is_revisor)
            <li>
              <a class="dropdown-item" href="{{ route('revisor.home') }}">
                {{__('Revisor')}}
                <span class="badge rounded-pill bg-danger">
                  {{\App\Models\Ad::ToBeRevisionedCount() }}
                </span>
              </a>
            </li>
            @endif
            <li>
              <form id="logoutForm" action="{{route('logout')}}" method="POST">
                @csrf
              </form>
              <a id="logoutBtn" class="dropdown-item" href="#">{{__('Salir')}}</a>
            </li>
          </ul>
        </li>
        @endguest
        <li class="nav-item">
          <x-locale lang="en" country="gb" />
        </li>
        
        <li class="nav-item">
          <x-locale lang="it" country="it" />
        </li>
        
        <li class="nav-item">
          <x-locale lang="es" country="es" />
        </li>
      </ul>
    </div>
  </div>
</nav>