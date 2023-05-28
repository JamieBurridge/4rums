<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/4rums/pages/board.php">4rums</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/4rums/pages/board.php">Board</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#">Profile</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">    
                    <?php require_once "../components/auth/logout_button.php"  ?>  
                </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>