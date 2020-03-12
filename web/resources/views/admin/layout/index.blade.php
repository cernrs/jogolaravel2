<!DOCTYPE html>
<html>

@includeif('admin.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@includeif('admin.layout.headers')
@includeif('admin.layout.sideBarLateral')
@includeif('admin.layout.messages')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @yield('content')

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @includeif('admin.layout.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@includeif('admin.layout.javascript')

</body>
</html>
