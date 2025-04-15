<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')?
                    'active' : '' }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">Tentang Akun</li>
                <li class="nav-item">
                    <a href="{{ url('/profil') }}" class="nav-link {{ ($activeMenu == 'profil') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>Profil</p>
                    </a>
                </li>
            </li>
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Level User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                <i class="nav-icon far fa-user"></i>
                <p>Data User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>Supplier</p>
                </a>
              </li>
            <li class="nav-header">Data Barang</li>
            <li class="nav-item">
                <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>Kategori Barang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>Data Barang</p>
                </a>
            </li>
            <li class="nav-header">Data Transaksi</li>
            <li class="nav-item">
                <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Stok Barang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Transaksi Penjualan</p>
                </a>
            </li>
        </li>

        <li class="nav-item mt-4">
            <a href="{{ url('/logout') }}" 
               class="nav-link btn btn-danger btn-block d-flex align-items-center justify-content-center" 
               style="background-color: #6e6a6a; color: white; border-radius: 8px; transition: all 0.3s ease-in-out; padding: 12px; font-size: 16px; font-weight: bold; border: 2px solid #6e6a6a;"
               onmouseover="this.style.backgroundColor='#e63946'; this.style.transform='scale(1.05)';" 
               onmouseout="this.style.backgroundColor='#6e6a6a'; this.style.borderColor='#6e6a6a'; this.style.transform='scale(1)';" 
               onclick="return confirm('Apakah Anda yakin akan logout dari halaman ini?');">
                <i class="nav-icon fas fa-sign-out-alt mr-2"></i>
                <span>Logout</span>
            </a>
        </li>        
        </ul>
    </nav>
</div>