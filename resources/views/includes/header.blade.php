<nav class="navbar navbar-dark navbar-expand-lg bg-primary mb-3">
  <div class="container-fluid px-5">

    <a class="navbar-brand" href="/"> <i class="fas fa-dumbbell" style="color: #ffffff;"></i> Lifting Reminder </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav d-flex justify-content-between w-100 mx-3">

        <div class="d-flex align-items-center gap-3 ms-5">
          @auth
            <li class="nav-item">
              <a class="nav-link p-0 active" aria-current="page" href="{{route('dashboard')}}">Tableau de bord</a>
            </li>

            <div class="header-separator rounded bg-light"></div>

            <li class="nav-item">
              <a class="nav-link p-0 active" aria-current="page" href="{{route('shared')}}">Communauté</a>
            </li>
          @endauth
        </div>

        @auth
          <li class="nav-item dropstart">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->name}}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form class="nav-item" action="{{route('logout')}}" method="post">
                  @csrf
                  <button class="dropdown-item"> Se déconnecter </button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
        
        @guest
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('login')}}">Connexion</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

