<?php
include __DIR__ . '../../_partials/top.php';
include('../../config/koneksi.php');
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Tambah Data Warga Lahir
        </h4>
    </div>
    <div class="col-sm-12 col-md-6 text-right">
        <a href="index.php" class="btn btn-info">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <form id="form">
            <div class="form-group">
                <label for="tanggal_pembuatan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= date('Y-m-d'); ?>" required />
            </div>
            <hr />
            <h1 class="text-center">Biodata Bayi</h1>
            <div class="form-group">
                <label for="nama_bayi">Nama Bayi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_bayi" name="nama_bayi" placeholder="Nama Bayi" required />
            </div>
            <div class="form-group">
                <label for="anak_ke">Anak ke <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="anak_ke" name="anak_ke" placeholder="Anak ke" step="1" min="1" required />
            </div>
            <div class="form-group">
                <label for="kota_kelahiran">Kota Kelahiran <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kota_kelahiran" name="kota_kelahiran" placeholder="Kota Kelahiran" required />
            </div>
            <div class="form-group">
                <label for="tempat_kelahiran">Tempat Kelahiran <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tempat_kelahiran" name="tempat_kelahiran" placeholder="Tempat Kelahiran" required />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= date('Y-m-d'); ?>" required />
            </div>
            <div class="form-group">
                <label for="jam_kelahiran">Jam Kelahiran <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="jam_kelahiran" name="jam_kelahiran" required />
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="radio">
                    <label class="jenis_kelamin_warga_l"><input type="radio" id="jenis_kelamin_warga_l" name="jenis_kelamin_warga" value="L"> Laki - laki</label>
                </div>
                <div class="radio">
                    <label class="jenis_kelamin_warga_p"><input type="radio" id="jenis_kelamin_warga_p" name="jenis_kelamin_warga" value="P"> Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="agama">Agama <span class="text-danger">*</span></label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value=""></option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <hr />
            <h1 class="text-center">Data Orang Tua</h1>
            <div class="form-group">
                <label for="ayah_id">Ayah <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ayah_id" name="ayah_id" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_ayah">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="ibu_id">Ibu <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ibu_id" name="ibu_id" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_ibu">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>

            <hr />
            <h1 class="text-center">Data Alamat</h1>
            <div class="form-group">
                <label for="alamat">Alamat Tinggal <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Tinggal" required></textarea>
            </div>
            <div class="form-group">
                <label for="rt">RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" required />
            </div>
            <div class="form-group">
                <label for="rw">RW <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" required />
            </div>
            <div class="form-group">
                <label for="desa">Desa/Kelurahan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="desa" name="desa" placeholder="Desa/Kelurahan" value="<?= DESA; ?>" required />
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="<?= KECAMATAN; ?>" required />
            </div>
            <div class="form-group">
                <label for="kokab">Kota/Kabupaten <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kokab" name="kokab" placeholder="Kota/Kabupaten" value="<?= KOKAB; ?>" required />
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi" value="<?= PROVINSI; ?>" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Warga yang Melaporkan <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="pelapor_id" name="pelapor_id" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_pelapor">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="hubungan_pelapor">Hubungan Pelapor <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hubungan_pelapor" name="hubungan_pelapor" placeholder="Hubungan Pelapor" required />
            </div>
            <hr />
            <h2 class="text-center">Tanda Tangan</h2>
            <div class="form-group">
                <label for="nama_ttd">Nama Penandatangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ttd" name="nama_ttd" placeholder="Nama Penandatangan" required />
            </div>
            <div class="form-group">
                <label for="jabatan_ttd">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jabatan_ttd" name="jabatan_ttd" placeholder="Jabatan" required />
            </div>
            <div class="form-group">
                <label for="nomor_induk_ttd">Nomor Induk</label>
                <input type="text" class="form-control" id="nomor_induk_ttd" name="nomor_induk_ttd" placeholder="Nomor Induk" />
            </div>
            <div class="form-group">
                <hr />
                <input type="hidden" id="ayah_id_hidden" name="ayah_id_hidden" />
                <input type="hidden" id="keluarga_id_hidden" name="keluarga_id_hidden" />
                <input type="hidden" id="ibu_id_hidden" name="ibu_id_hidden" />
                <input type="hidden" id="pelapor_id_hidden" name="pelapor_id_hidden" />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<form id="form_ayah">
    <div class="modal fade" id="modal_ayah" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Ayah</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ayah_keyword">Nama Ayah</label>
                        <input type="text" class="form-control" id="ayah_keyword" name="ayah_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_ayah">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_ibu">
    <div class="modal fade" id="modal_ibu" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Ibu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ibu_keyword">Nama Ibu</label>
                        <input type="text" class="form-control" id="ibu_keyword" name="ibu_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_ibu">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_pelapor">
    <div class="modal fade" id="modal_pelapor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Pelapor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pelapor_keyword">Nama Pelapor</label>
                        <input type="text" class="form-control" id="pelapor_keyword" name="pelapor_keyword" minlength="3" placeholder="Ketik Nama Pelapor" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_pelapor">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="./create_vitamin.js"></script> -->
<script>
    let id_print = null;
    $(document).ready(() => {
        $("#form").on("submit", function(e) {
            e.preventDefault();
            if ($("#ayah_id").val().length == 0) {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Pilih Warga yang Bekerja",
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                }).then(() => $("#btn_modal_ayah").trigger("click"));
            } else if ($("#pelapor_id").val().length == 0) {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Pilih Pelapor",
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                }).then(() => $("#btn_modal_pelapor").trigger("click"));
            } else {
                simpanData();
            }
        });

        $("#btn_print").on("click", (e) => {
            window.open(`print.php?id=${id_print}`);
        });
    });

    const defaultListWarga = `
    <tr>
        <td>Data Tidak Ditemukan</td>
    </tr>
    `;

    function vListAyahDefault() {
        $("#v_list_ayah").html(defaultListWarga);
    }

    function vListIbuDefault() {
        $("#v_list_ibu").html(defaultListWarga);
    }

    // AYAH START
    $("#btn_modal_ayah").on("click", (e) => {
        e.preventDefault();
        $("#modal_ayah").modal("show");
    });

    $("#modal_ayah").on("shown.bs.modal", function() {
        $("#ayah_keyword").focus();
    });

    $("#ayah_keyword").on("keyup", () => {
        const ayahKeyword = $("#ayah_keyword").val();
        if (ayahKeyword.length >= 3) {
            findAyah(ayahKeyword);
        }
    });

    $("#form_ayah").on("submit", (e) => {
        e.preventDefault();
    });

    function findAyah(ayahKeyword) {
        $.ajax({
            url: `ajax_list_ayah.php`,
            type: "get",
            dataType: "json",
            data: {
                keyword: ayahKeyword,
            },
            beforeSend: () => {
                $("#v_list_ayah").html(defaultListWarga);
            },
        }).done((e) => {
            if (e.code == 200) {
                if (e.total > 0) {
                    let htmlnya = ``;
                    $.each(e.data, (i, k) => {
                        htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihAyah(${k.id_warga}, '${k.nama_warga}', '${k.id_keluarga}', '${k.alamat_keluarga}', '${k.rt_warga}', '${k.rw_warga}')"><small>(${k.nik_warga})</small> ${k.nama_warga}</td>
                    </tr>
                    `;
                    });
                    $("#v_list_ayah").html(htmlnya);
                } else {
                    vListAyahDefault();
                }
            } else {
                vListAyahDefault();
            }
        });
    }

    function pilihAyah(
        id_warga,
        nama_warga,
        id_keluarga,
        alamat_keluarga,
        rt_warga,
        rw_warga
    ) {
        $("#ayah_id_hidden").val(id_warga);
        $("#ayah_id").val(nama_warga);
        $("#keluarga_id_hidden").val(id_keluarga);
        $("#alamat").val(alamat_keluarga);
        $("#rt").val(rt_warga);
        $("#rw").val(rw_warga);
        $("#modal_ayah").modal("hide");
    }
    // AYAH END

    // IBU START
    $("#btn_modal_ibu").on("click", (e) => {
        e.preventDefault();
        $("#modal_ibu").modal("show");
    });

    $("#modal_ibu").on("shown.bs.modal", function() {
        $("#ibu_keyword").focus();
    });

    $("#ibu_keyword").on("keyup", () => {
        const ibuKeyword = $("#ibu_keyword").val();
        if (ibuKeyword.length >= 3) {
            findIbu(ibuKeyword);
        }
    });

    $("#form_ibu").on("submit", (e) => {
        e.preventDefault();
    });

    function findIbu(ibuKeyword) {
        $.ajax({
            url: `ajax_list_ibu.php`,
            type: "get",
            dataType: "json",
            data: {
                keyword: ibuKeyword,
            },
            beforeSend: () => {
                $("#v_list_ibu").html(defaultListWarga);
            },
        }).done((e) => {
            if (e.code == 200) {
                if (e.total > 0) {
                    let htmlnya = ``;
                    $.each(e.data, (i, k) => {
                        htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihIbu(${k.id_warga}, '${k.nama_warga}')"><small>(${k.nik_warga})</small> ${k.nama_warga}</td>
                    </tr>
                    `;
                    });
                    $("#v_list_ibu").html(htmlnya);
                } else {
                    vListIbuDefault();
                }
            } else {
                vListIbuDefault();
            }
        });
    }

    function pilihIbu(id_warga, nama_warga) {
        $("#ibu_id_hidden").val(id_warga);
        $("#ibu_id").val(nama_warga);
        $("#modal_ibu").modal("hide");
    }
    // IBU END

    // PELAPOR START
    $("#btn_modal_pelapor").on("click", (e) => {
        e.preventDefault();
        $("#modal_pelapor").modal("show");
    });

    $("#modal_pelapor").on("shown.bs.modal", function() {
        $("#pelapor_keyword").focus();
    });

    $("#pelapor_keyword").on("keyup", () => {
        const pelaporKeyword = $("#pelapor_keyword").val();
        if (pelaporKeyword.length >= 3) {
            findPelapor(pelaporKeyword);
        }
    });

    $("#form_pelapor").on("submit", (e) => {
        e.preventDefault();
    });

    function findPelapor(pelaporKeyword) {
        $.ajax({
            url: `ajax_list_warga.php`,
            type: "get",
            dataType: "json",
            data: {
                keyword: pelaporKeyword,
            },
            beforeSend: () => {
                $("#v_list_pelapor").html(defaultListWarga);
            },
        }).done((e) => {
            if (e.code == 200) {
                if (e.total > 0) {
                    let htmlnya = ``;
                    $.each(e.data, (i, k) => {
                        htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihPelapor(${k.id_warga}, '${k.nama_warga}')">${k.nama_warga}</td>
                    </tr>
                    `;
                    });
                    $("#v_list_pelapor").html(htmlnya);
                } else {
                    vListAyahDefault();
                }
            } else {
                vListAyahDefault();
            }
        });
    }

    function pilihPelapor(id_warga, nama_warga) {
        $("#pelapor_id_hidden").val(id_warga);
        $("#pelapor_id").val(nama_warga);
        $("#modal_pelapor").modal("hide");
    }
    // PELAPOR END

    function simpanData() {
        $.ajax({
                url: `ajax_store_warga.php`,
                type: "post",
                dataType: "json",
                data: $("#form").serialize(),
                beforeSend: () => {
                    $("#btn_simpan").attr("disabled", true);
                    $("#btn_print").attr("disabled", true);
                },
            })
            .fail(() => {
                $("#btn_simpan").attr("disabled", false);
                $("#btn_print").attr("disabled", true);
            })
            .done((e) => {
                id_print = e.id;
                if (e.code == 200) {
                    $("#btn_print").attr("disabled", false);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: e.msg,
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                    }).then((e) => {
                        $("#btn_print").trigger("click");
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: e.msg,
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                    });
                    $("#btn_simpan").attr("disabled", false);
                    $("#btn_print").attr("disabled", true);
                }
            });
    }
</script>