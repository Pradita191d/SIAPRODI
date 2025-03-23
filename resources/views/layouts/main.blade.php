@include('layouts.header')
@include('layouts.navbar')
@include('layouts.sidebar')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   @yield('content')
   <!-- /.content --> 
 </div>
 <!-- /.content-wrapper -->

 @include('layouts.footer')
