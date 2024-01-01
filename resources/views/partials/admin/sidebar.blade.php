 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
        $isTablesActive = request()->is('user*') || request()->is('role*') || request()->is('vendor*') || request()->is('satuan*') || request()->is('barang*');
    @endphp
      <li class="nav-item">
        <a class=" nav-link {{ request()->routeIs('admin.home') ? 'active' : 'collapsed' }}" id="dashboard-link"  href="{{ route('admin.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- Menu Table -->

      <li class="nav-item">
        <a id="tablesLink" class="nav-link  {{  $isTablesActive ? 'active' : 'collapsed'  }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Table Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse {{ $isTablesActive ? 'show' : '' }} " data-bs-parent="#sidebar-nav">
          <li>
         <a class ="nav-link {{request()->is('role*') ? 'active' : ''}}"  href="{{ route('role.index') }}">
              <i class="bi bi-circle"></i><span>Role Table</span>
            </a>
          </li>

          <li>
            <a class ="nav-link {{request()->is('user*') ? 'active' : ''}}"  href="{{ route('user.index') }}">
                 <i class="bi bi-circle"></i><span>User Table</span>
               </a>
             </li>
          <li>
            <a  class= 'nav-link {{ request()->is('vendor*') ? 'active' : '' }}'href="{{ route('vendor.index') }}">
              <i class="bi bi-circle"></i><span>Vendor Table</span>
            </a>
          </li>
          <li>
            <a class= 'nav-link {{ request()->is('satuan*') ? 'active' : '' }}' href="{{ route('satuan.index') }}">
              <i class="bi bi-circle"></i><span>Satuan Table</span>
            </a>
          </li>
          <li>
            <a class= "nav-link {{ request()->is('barang*') ? 'active' : '' }}" href="{{ route('barang.index') }}">
              <i class="bi bi-circle"></i><span>Barang Table</span>
            </a>
          </li>




        </ul>


      </li><!-- End Tables Nav -->

      @php
      $isTablesActive2 = request()->is('pengadaan*') || request()->is('penerimaan*') || request()->is('retur*') ;
  @endphp
      <li class="nav-item">
        <a id="tablesLink" class="nav-link  {{  $isTablesActive2 ? 'active' : 'collapsed'  }}" data-bs-target="#tables-nav2" data-bs-toggle="collapse" href="#">
            <i class="bi bi-cash-stack"></i><span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav2" class="nav-content collapse {{ $isTablesActive2 ? 'show' : '' }} " data-bs-parent="#sidebar-nav">

          <li>
            <a class= "nav-link {{ request()->is('pengadaan*') ? 'active' : '' }}" href="{{ route('pengadaan.index') }}">
              <i class="bi bi-circle"></i><span>Pengadaan Table</span>
            </a>
          </li>

          <li>
            <a class= "nav-link {{ request()->is('penerimaan*') ? 'active' : '' }}" href="{{ route('penerimaan.index') }}">
              <i class="bi bi-circle"></i><span>Penerimaan Table</span>
            </a>

            <li>
                <a class= "nav-link {{ request()->is('retur*') ? 'active' : '' }}" href="{{ route('retur.index') }}">
                  <i class="bi bi-circle"></i><span>Retur Table</span>
                </a>
          </li>


        </ul>


      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('kartuStock*') ? 'active' : 'collapsed'  }}" href="{{ route('kartuStok.index') }}">
            <i class="bi bi-clipboard2-data-fill"></i>
          <span>Kartu Stok</span>
        </a>
        <!--End Kartu Stock Page Nav -->
      </li><!-- End Login Page Nav -->






    </ul>


  </aside><!-- End Sidebar-->


