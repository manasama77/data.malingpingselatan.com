<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="../dasbor">Aplikasi Kependudukan Griya Sangiangmas - Gebang Raya - Periuk Kota Tangerang</a>-->
            <a class="navbar-brand" href="../dasbor" style="font-size: 15px;">
                <marquee width="100%" direction="right" loop="-1" style="color: #428BCA;">
                    Aplikasi Kependudukan Malingping Selatan Banten - <small>Kp. Lebak Lame RT. 02 RW 02 Desa Malingping Selatan Kecamatan Malingping Kab. Lebak Prov. Banten</small>
                </marquee>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text"><i class="fa fa-user"></i> Hai, <?php echo $_SESSION['user']['nama_user'] ?></p>
                <li><a href="../dasbor"><i class="fa fa-home"></i> Dashbord</a></li>
                <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>