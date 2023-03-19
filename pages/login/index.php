<?php
session_start();
require('../../pages/constant.php');
// jika sudah login, alihkan ke halaman dasbor
if (isset($_SESSION['user'])) {
  header('Location: ../dasbor/index.php');
  exit();
}

?>

<?php include('../_partials/top-login.php') ?>
<style>
  @media only screen and (min-width: 992px) {

    html,
    body {
      margin: 0;
      height: 100%;
    }
  }
</style>

<body class="unsplash-bg-random">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-heading text-center">
              FORM LOGIN APLIKASI KEPENDUDUKAN <?= strtoupper(DESA); ?><br /><?= strtoupper(PROVINSI); ?><br />
            </h3>
            <div class="text-center">
              <img src="../../assets/img/<?= LOGO; ?>" style="background-size: cover; width: 50%;" class="img-thumbnail" />
            </div>
          </div>
        </div>


        <div class="panel-heading">
          <h3 class="panel-title text-center">Silahkan Login Terlebih Dahulu</h3>
        </div>
        <div class="panel-body">
          <form role="form" method="post" action="../login/proses-login.php">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="Nama Pengguna" name="username_user" type="username" required="" autofocus>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Kata Sandi" name="password_user" type="password" value="" required="">
              </div>
              <div class="form-group">
                <label for="password">Captcha</label>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <input type="text" class="form-control" name="captcha" id="captcha" minlength="4" maxlength="4" required />
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <img src="../../assets/captcha.php" alt="PHP Captcha" style="width: 100%;">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-lg btn-primary btn-block">Masuk </button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include('../_partials/bottom-login.php') ?>