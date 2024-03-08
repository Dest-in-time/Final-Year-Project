<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="assets/dist/css/login_style.css">

</head>
<style>
  body {
    font-family: "Lato", Arial, sans-serif !important;
    font-size: 16px !important;
    line-height: 1.8 !important;
    font-weight: normal !important;
    background: #f8f9fd !important;
    color: gray !important;
  }

  .heading-section {
    background: #fff;
    width: 433px;
    display: inline-block;
    padding: 10px;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    -webkit-box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
    -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
  }

  #top_header {
    margin-bottom: 0px !important;
    text-align: center !important;
  }

  .login-wrap .icon {
    background: unset;
    margin-bottom: 30px;
  }

  #school_logo {
    width: 60px;
    border-radius: 10px;
  }

  .checkbox-primary input:checked~.checkmark:after {
    color: #004282 !important;
  }

  .checkbox-primary {
    color: #004282 !important;
    font-size: 1rem;
    margin-top: 10px;
  }

  #lock_ico {
    width: 37px;
    display: flex;
    justify-content: center;
  }

  ::placeholder {
    /* Chrome, Firefox, Opera, Safari 10.1+ */
    font-weight: 600;
    opacity: 1;
    /* Firefox */
  }

  :-ms-input-placeholder {
    /* Internet Explorer 10-11 */
    font-weight: 600;
  }

  ::-ms-input-placeholder {
    /* Microsoft Edge */
    font-weight: 600;
  }

  #signin_btn {
    background: #004282 !important;
    border: 1px solid #004282 !important;
  }

  @media only screen and (max-width: 1199px) {
    .heading-section {
      background: unset;
      width: 433px;
      display: inline-block;
      padding: 10px;
      border-top-left-radius: 50px;
      border-top-right-radius: 50px;
      -webkit-box-shadow: unset;
      -moz-box-shadow: unset;
      box-shadow: unset;
    }
  }

  @media only screen and (max-width: 991px) {
    .heading-section {
      width: 330px;
      padding-left: 0px;
      padding-right: 0px;
    }
  }

  @media only screen and (max-width: 383px) {
    .heading-section {
      font-size: 1.6rem;
    }
  }

  @media only screen and (max-width: 347px) {
    .heading-section {
      width: 100%;
    }
  }
</style>
<?php
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
  $_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>
<?php
if (isset($_SESSION['login_id']))
  header("location:index.php?page=home");

?>
<?php include 'header.php' ?>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5" id="top_header">
          <h2 class="heading-section"><?php echo $_SESSION['system']['name'] ?></h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="login-wrap p-4 p-md-5">
            <div class="icon d-flex align-items-center justify-content-center">
              <img id="school_logo" src="assets/uploads/Babcock-University.jpg" alt="">
            </div>
            <form action="" id="login-form" class="login-form">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div id="lock_ico" class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div id="lock_ico" class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                <input type="text" class="form-control" name="matric_no" placeholder="Matric No">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div id="lock_ico" class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group mb-3">
                <label style="font-size: 1rem;" for="">Login As</label>
                <select style="height: 33.5px;" name="login" id="" class="custom-select custom-select-sm">
                  <option value="3">Student</option>
                  <option value="2">Lecturer</option>
                  <option value="1">Administrator</option>
                </select>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50">
                  <label class="checkbox-wrap checkbox-primary">Remember Me
                    <input type="checkbox" checked>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" id="signin_btn" class="btn btn-primary rounded submit p-3 px-5">Sign In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
      $('#login-form').submit(function(e) {
        e.preventDefault()
        start_load()

        var email = $('[name="email"]').val();
        var password = $('[name="password"]').val();
        var select_option = $('[name="login"]').val();
        var matric_no = $('[name="matric_no"]').val();
        var conditions;

        conditions = /^ *$/.test(password) || /^ *$/.test(select_option) || email.match(/.+@.+\..+/) == false;

        if (conditions) {
          end_load();
          $("div").remove(".alert, .alert-danger");
          $('#login-form').prepend('<div class="alert alert-danger" style="padding: 6px; text-align: center; font-size: 1rem;">Fill in the details below properly!</div>');
        } else {
          if (select_option === '3') {
            if (/^ *$/.test(matric_no)) {
              end_load();
              $("div").remove(".alert, .alert-danger");
              $('#login-form').prepend('<div class="alert alert-danger" style="padding: 6px; text-align: center; font-size: 1rem;">Matric number missing!</div>');
            } else {
              $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                  end_load();

                },
                success: function(resp) {
                  if (resp == 1) {
                    location.href = 'index.php?page=home';
                  } else if (resp == 3) {
                    $("div").remove(".alert, .alert-danger");
                    $('#login-form').prepend('<div class="alert alert-danger" style="padding: 6px; text-align: center; font-size: 1rem;">Wrong matric number.</div>')
                    end_load();
                  } else {
                    $("div").remove(".alert, .alert-danger");
                    $('#login-form').prepend('<div class="alert alert-danger" style="padding: 6px; text-align: center; font-size: 1rem;">Email or password is incorrect.</div>')
                    end_load();
                  }
                }
              })
            }
          } else {
            $.ajax({
              url: 'ajax.php?action=login',
              method: 'POST',
              data: $(this).serialize(),
              error: err => {
                end_load();

              },
              success: function(resp) {
                if (resp == 1) {
                  location.href = 'index.php?page=home';
                } else {
                  $("div").remove(".alert, .alert-danger");
                  $('#login-form').prepend('<div class="alert alert-danger" style="padding: 6px; text-align: center; font-size: 1rem;">Email or password is incorrect.</div>')
                  end_load();
                }
              }
            })
          }
        }
      })
    })
  </script>
  <?php include 'footer.php' ?>

</body>

</html>