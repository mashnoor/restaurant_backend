<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.layouts.header')

<style>
  .login_content.loginsite .btnnew{ float: none; margin:20px auto; }  
</style>

</head>

<body style="background:#F7F7F7;">

  <div id="wrapper">

    <section class="login_content loginsite">

      {!! Form::open(['route' => 'user.postLogin', 'method' => 'post', 'class'=> 'form-horizontal']) !!}
        <h1>Restaurant Login</h1>
        <p>Please login into your account.</p>

        <div class="col-md-12">
          {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
          <span class="small text-danger">{{ $errors->first('username') }}</span>
        </div>

        <div class="col-md-12">
          {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
          <span class="small text-danger">{{ $errors->first('password') }}</span>
        </div>
        
        <div class="col-md-12" style="margin:0 auto; text-align: center;">
          {{ Form::submit('Submit', ['class' => 'btn btn-default btnnew']) }}
        </div>

        <div class="col-md-12" style="margin:20px auto; text-align: center;">
          <p>&copy; <?php echo date("Y"); ?>. Design & Developed by <a href="http://rajit.net/" target="_blank">raj IT Solutions Ltd.</a></p>
        </div>

      {!! Form::close() !!}

    </section>
    <!-- content -->
  </div>

</body>
</html>
