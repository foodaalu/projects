<?php 
  
    require $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/init.php';
    if (isset($_SESSION, $_SESSION['token']) && !empty($_SESSION['token'])) 
    {
        redirect('dashboard.php', 'success','You are already logged in.');
    }
    
    if (isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au']))
    {
      redirect('dashboard.php', 'success', 'Welcome back!');
    }
  include 'inc/header.php';  
?>

  <div class="container">
    
    <!-- Outer Row -->
    <div class="row justify-content-center">

    <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <img class="img img-fluid" style="width: 30%;padding-bottom: 20px;" src="http://corporate.sherpachat.com/images/logo-white.svg">
                  </div>
                  <form class="user" method="post" action="process/login.php">
                    <div class="row">
                      <div class="col-md-12">
                        <?php flash(); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail"  name ="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" value="Remember Me">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
<?php include 'inc/footer.php';?>