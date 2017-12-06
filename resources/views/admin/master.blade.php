<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.header')
</head>


<body class="nav-md">

  <div class="container body">

    <div class="main_container">

      @include('admin.layouts.sidebar')

      @include('admin.layouts.headerTop')

      <!-- page content -->
      <div class="right_col" role="main">

        @include('admin.alertMessages')
        @yield('content')
        


        <!-- footer content -->
        {{-- <footer>
          <div class="copyright-info">
            <p class="pull-right">Resturant - All Rights Reserved - 2017 <a href="http://rajit.net">Raj-IT</a>  
            </p>
          </div>
          <div class="clearfix"></div>
        </footer> --}}
        <!-- /footer content -->
      </div>
      <!-- /page content -->
     <footer>
        <div class="copyright-info">
          <p class="pull-right">Resturant - All Rights Reserved - 2017 <a href="http://rajit.net">Raj-IT</a>  
          </p>
        </div>
        <div class="clearfix"></div>
      </footer>

    </div>
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

    @include('admin.layouts.javascript')
  
    @yield('scripts')
</body>

</html>
