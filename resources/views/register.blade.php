
  <!-- Header  content -->
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/adminlte.min.css')}}">
</head>

<!-- End Header -->
  
<!-- Sidebar  content -->


<!-- End Sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Register Here </h3>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{url('register')}}" id="quickForm" >
				  @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                    @error('name')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    @error('email')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                    @error('password')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone">
                    @error('phone')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Register</button>  <a href="{{url('login')}}" class="btn btn-primary">Login Here</a>
                </div>
				@if ( Session::has('errorMsg') )

  <div class="alert alert-danger "> 
      <h5><i class="icon fas fa-ban"></i>{{ Session::get('errorMsg') }}</h5>
  </div>
  
@endif
 @if ( Session::has('logoutMsg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('logoutMsg') }}</h5>
                </div>
@endif

@if ( Session::has('reg_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('reg_add_msg') }}</h5>
                </div>
@endif
              </form>
			 
			  
			  
			 
			  
			  
			  
			  
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  <!-- Footer  content -->


<!-- End Footer -->

<style> 
body{
background-color: #f4f6f9;
}
.card {
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    margin-bottom: 1rem;
    width: 80%;
}
</style>