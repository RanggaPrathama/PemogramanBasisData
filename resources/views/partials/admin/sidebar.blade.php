 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- Menu Table -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('role.index') }}">
              <i class="bi bi-circle"></i><span>Role Table</span>
            </a>
          </li>
          <li>
            <a href="{{ route('vendor.index') }}">
              <i class="bi bi-circle"></i><span>Vendor Table</span>
            </a>
          </li>
          <li>
            <a href="{{ route('satuan.index') }}">
              <i class="bi bi-circle"></i><span>Satuan Table</span>
            </a>
          </li>
          <li>
            <a href="{{ route('barang.index') }}">
              <i class="bi bi-circle"></i><span>Barang Table</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

    </ul>

  </aside><!-- End Sidebar-->
