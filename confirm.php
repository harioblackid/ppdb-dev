<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Candy PPDB</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  
  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand" style="margin-bottom: 15px">
              <img src="../<?= $setting['logo'] ?>" alt="logo" width="80" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Silahkan Atur Ulang Password Anda</h4>
              </div>

              <div class="card-body">
                <form id="form-login" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="password1">Password Baru</label>
                    <input id="password1" type="text" class="form-control" name="password1" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Mohon di isi
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password2" class="control-label">Password </label>
                    </div>
                    <input id="password2" type="password" class="form-control" name="password2" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon di isi
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kolom1">Input Test</label>
                    <input id="kolom1" type="text" class="form-control" name="input1" tabindex="3" required autofocus>
                    <div class="invalid-feedback">
                      Mohon di isi
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <button name="login" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>


              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; CANDY <?= date('Y') ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <!-- <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script> -->
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

  <script>
    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });

    $.getJSON('crud_web.php?pg=jurusan', function(data) {
      console.log(data);
    });

    $('#formlogin').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'ubah_password.php',
        data: $(this).serialize(),
        success: function(data) {
          if (data == "ok") {
            iziToast.success({
              title: 'Berhasil!',
              message: 'Anda akan dialihkan',
              position: 'topRight'
            });
            setTimeout(function() {
              window.location.reload();
            }, 2000);
          } else {
            iziToast.error({
              title: 'Maaf Bro',
              message: 'Username atau Password Salah',
              position: 'topCenter'
            });
          }
        }
      });
      return false;
    });

    $("#form-login").validate({
      rules: {
        fullname: {
          required: true
        },

        password1: {
          required: true,
          minlength: 4
        },

        password2: {
          required: true,
          minlength: 4,
          equalTo: password1,
          
        }
      }
    });    
  </script>
</body>

</html>