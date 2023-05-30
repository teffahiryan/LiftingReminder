<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid mx-5">

    <a class="navbar-brand fw-bold" href="#">Lifting Reminder</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <form class="mx-auto my-2 w-50">
        <input class="form-control me-2 rounded-pill" type="search" placeholder="Rechercher une recette..." aria-label="Search">
        {{-- <button class="btn btn-light rounded-circle" type="submit"> <i class="fas fa-search"></i> </button> --}}
      </form>

      <ul class="navbar-nav">
        @auth
          {{-- Méthode conseillé pour le bouton logout via formulaire --}}
          <li class="nav-item dropstart">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Recette</a></li>
              <li><a class="dropdown-item" href="#">Catégorie</a></li>
              <li><a class="dropdown-item" href="#">Ingrédient</a></li>
            </ul>
          </li>
        @endauth

        {{-- S'il n'est pas connecté alors il est un invité @guest qu'on invite a se connecter --}}
        @guest
          <li class="nav-item">
              <a class="nav-link active" href="#"> Se connecter </a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>