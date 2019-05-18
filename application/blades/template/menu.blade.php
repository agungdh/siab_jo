<li>
  <a href="{{ base_url() }}absensi">
    <i class="fa fa-address-book"></i> <span>Absensi</span>
  </a>
</li>

<li>
  <a href="{{ base_url() }}riwayatabsensi">
    <i class="fa fa-book"></i> <span>Riwayat Absensi</span>
  </a>
</li>

@if($userData->level == 'a')
<li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <li>
          <a href="{{ base_url() }}pegawai">
            <i class="fa fa-users"></i> <span>Pegawai</span>
          </a>
        </li>

        <li>
          <a href="{{ base_url() }}user">
            <i class="fa fa-users"></i> <span>User</span>
          </a>
        </li>

        <li>
          <a href="{{ base_url() }}harilibur">
            <i class="fa fa-calendar"></i> <span>Hari Libur</span>
          </a>
        </li>

      </ul>
</li>
@endif