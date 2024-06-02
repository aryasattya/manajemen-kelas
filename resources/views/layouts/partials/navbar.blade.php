  
 

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto p-2">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                
                <p>
                  <i class="fas fa-user"></i>
                  {{Auth::user()->username}}
                </p>
            </a>

            
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('logout') }}" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

  <!-- /.navbar -->