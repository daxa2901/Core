<div class="content-wrapper" style="min-height: 100.4px;">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin Login</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row ">
                  <div class="col-sm-12 mx-auto">
                    <div class="container login-page ">
                      <div class="login-box">
                        <!-- /.login-logo -->
                        <div class="card card-outline card-primary">
                          <div class="card-header text-center">
                            <a href="#" class="h1"><b>Admin</b>Login</a>
                          </div>
                          <div class="card-body">
                            <p class="login-box-msg">Sign in to start your session</p>

                            <form action="<?php echo $this->getUrl('loginPost');?>" method="post" >
                              <div class="input-group mb-3">
                                <input type="email" class="form-control" name = login[email] placeholder="Email">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                  </div>
                                </div>
                              </div>
                              <div class="input-group mb-3">
                                <input type="password" class="form-control" name = login[password] placeholder="Password">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-8">
                                  <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                      Remember Me
                                    </label>
                                  </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                              </div>
                            </form>

                            <div class="social-auth-links text-center mt-2 mb-3">
                              <a href="#" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                              </a>
                              <a href="#" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                              </a>
                            </div>
                            <!-- /.social-auth-links -->

                            <p class="mb-1">
                              <a href="forgot-password.html">I forgot my password</a>
                            </p>
                            <p class="mb-0">
                              <a href="register.html" class="text-center">Register a new membership</a>
                            </p>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
</div>
