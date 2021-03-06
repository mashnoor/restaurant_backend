<div class="col-md-3 left_col">
  <div class="left_col scroll-view">

    <!-- menu prile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        {{-- <h2>Admin Panel</h2> --}}
      </div>
    </div>
    <!-- /menu prile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

      <div class="menu_section">
        <h3>Admin Panel</h3>
        <ul class="nav side-menu">

          <li><a><i class="fa fa-users"></i> User <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li>
                <a href="{{ URL::route('user.index') }}">All Users</a>
              </li>
              <li>
                <a href="{{ URL::route('user.create') }}">Create user</a>
              </li>
            </ul>
          </li>

          <li><a><i class="fa fa-home"></i> Menu <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li>
                <a href="{{ URL::route('menu.index') }}">Menu Items</a>
              </li>
              <li>
                <a href="{{ URL::route('menu.create') }}">Menu Create</a>
              </li>
            </ul>
          </li>

          <li><a><i class="fa fa-percent"></i> Discount <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li>
                <a href="{{ URL::route('discount.index') }}">All Discounts</a>
              </li>
              <li>
                <a href="{{ URL::route('discount.create') }}">Create Discount</a>
              </li>
            </ul>
          </li>

          <li><a><i class="fa fa-list-ul"></i> Category <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li>
                <a href="{{ URL::route('category.index') }}">All Category</a>
              </li>
              <li>
                <a href="{{ URL::route('category.create') }}">Create Category</a>
              </li>
            </ul>
          </li>

          <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="{{ URL::route('table.index') }}">Tables</a></li>
              <li><a href="{{ URL::route('table.create') }}">Create Table</a></li>
            </ul>
          </li>

          <li><a><i class="fa fa-cutlery"></i> Kitchen <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="{{ URL::to('/order') }}">Order Process</a></li>
              <li><a href="{{ URL::to('/order/available') }}">Off Menus</a></li>
            </ul>
          </li>

          <li><a><i class="fa fa-cutlery"></i> Pantry <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="{{ URL::to('/pantry') }}">Pantry Orders</a></li>
            </ul>
          </li>

          <li><a><i class="fa fa-cogs"></i> Manager <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="{{ URL::to('/order/manages') }}">Manage Orders</a></li>
            </ul>
          </li>

          <li><a><i class="fa fa-line-chart"></i> Daily Report <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="{{ URL::to('reports') }}">Daily Reports</a></li>
            </ul>
          </li>

        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a href="{{ route('user.logout') }}" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>