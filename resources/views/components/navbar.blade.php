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
          <a class="nav-link" href="#">Quienes somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Donde estamos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="{{route('category.ads',$category)}}">{{$category->name}}</a></li>
            @endforeach
          </ul>
        </li>
        @guest
        @if (Route::has('login'))
        <li class="nav-item ">
          <a class="nav-link"
          href="{{route('login')}}"><span>Login</span></a>
        </li>
        @endif    
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link"
          href="{{route('register')}}"><span>Register</span></a>
        </li>
        @endif
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('ads.create') }}">
            New Ad
          </a>
        </li>
        @if (Auth::user()->is_revisor)
        <li class="nav-item">
          <a class="nav-link" href="{{ route('revisor.home') }}">
            Revisor Casa
            <span class="badge rounded-pill bg-danger">
              {{\App\Models\Ad::ToBeRevisionedCount() }}
            </span>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <form id="logoutForm" action="{{route('logout')}}" method="POST">
            @csrf
          </form>
          <a id="logoutBtn" class="nav-link" href="#">Logout</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>