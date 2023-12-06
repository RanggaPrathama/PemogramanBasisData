 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
        $isTablesActive = request()->is('role*') || request()->is('vendor*') || request()->is('satuan*') || request()->is('barang*');
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
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
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
        <li class="nav-item">
            <a class="nav-link {{ request()->is('register') ? 'active' : 'collapsed'  }}" href="{{ route('register') }}">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Register</span>
            </a>
          </li><!-- End Login Page Nav -->
      </li><!-- End Tables Nav -->

    </ul>


  </aside><!-- End Sidebar-->


