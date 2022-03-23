<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding-top: 5px;">
        <img src="../../assets/img/logo.png" alt="Logo" style="width: 30px;" />
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav hidden-md hidden-lg">
        <li><a href="../dasbor"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="../warga"><i class="fa fa-user"></i> Data Penduduk</a></li>
        <li><a href="../kartu-keluarga"><i class="fa fa-users"></i> Data Kartu Keluarga</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-exchange fa-fw"></i> Mutasi <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../mutasi-datang"><i class="fa fa-long-arrow-right fa-fw"></i> Pindah Datang</a></li>
            <li><a href="../mutasi-keluar"><i class="fa fa-long-arrow-left fa-fw"></i> Pindah Keluar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-newspaper-o fa-fw"></i> Peristiwa <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../kelahiran"><i class="fa fa-venus-mars fa-fw"></i> Kelahiran</a></li>
            <li><a href="../meninggal"><i class="fa fa-ambulance fa-fw"></i> Kematian</a></li>
          </ul>
        </li>
        <?php if ($_SESSION['user']['status_user'] != 'Kasi_Pemerintahan') : ?>
          <li><a href="../user"><i class="fa fa-user-secret"></i> User</a></li>
        <?php endif; ?>
      </ul>
      <hr class="hidden-md hidden-lg" />
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-secret"></i> Hai, <?php echo $_SESSION['user']['nama_user'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>