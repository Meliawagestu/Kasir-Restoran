<ul class="sidebar navbar-nav">
  @if(Auth::user()->akses == 'admin'  || Auth::user()->akses == 'owner')
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        @endif

        @if(Auth::user()->akses == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.user')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
          </a>
        </li>

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Daftar Masakan</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{route('admin.masakan')}}"><i class="fas fa-utensils"></i> Menu Masakan</a>
            <a class="dropdown-item" href="{{route('admin.kategori')}}"><i class="fas fa-fw fa-list"></i> Kategori</a>
          </div>
        </li>
        @endif

         @if(Auth::user()->akses =='admin' || Auth::user()->akses =='waiter')
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cart-plus"></i>
            <span>Order</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{route('admin.entripemesanan')}}"><i class="fa fa-cart-plus"></i> Entri Order</a>
            <a class="dropdown-item" href="{{route('admin.pemesanan')}}"><i class="fas fa-shopping-cart"></i> History Order</a>
          </div>
        </li>
        @endif

        @if(Auth::user()->akses =='admin' || Auth::user()->akses =='kasir')
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-money-check-alt"></i>
            <span>Kasir</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{route('cashier')}}"><i class="fas fa-money-check-alt"></i> Transaksi</a>
            <a class="dropdown-item" href="{{route('admin.transaksi')}}"><i class="fas fa-money-check-alt"></i></i> History Transaksi</a>
          </div>
        </li>

        @endif
      </ul>