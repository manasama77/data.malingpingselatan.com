<?php include __DIR__ . '../../_partials/top.php' ?>

<?php include('../../config/koneksi.php'); ?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Tambah Data Domisili
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
            <div class="form-group">
                <label for="nik">NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nik" placeholder="NIK" required />
            </div>
            <div class="form-group">
                <label for="nama">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required />
                <!-- <div class="input-group">
                    <input type="text" class="form-control" id="warga_id" name="warga_id" required disabled />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_warga">
                        <i class="fa fa-search"></i>
                    </div>
                </div> -->
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tempat_lahir" required />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="tanggal_lahir" required />
            </div>
            <div class="form-group">
                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="radio">
                    <label for="jenis_kelamin_laki">
                        <input type="radio" id="jenis_kelamin_laki" name="jenis_kelamin" value="L" required checked />
                        Laki-laki
                    </label>
                </div>
                <div class="radio">
                    <label for="jenis_kelamin_perempuan">
                        <input type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="P" required />
                        Perempuan
                    </label>
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
            <div class="form-group">
                <label for="status_perkawinan">Status Perkawinan<span class="text-danger">*</span></label>
                <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                    <option value=""></option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pekerjaan" required />
            </div>
            <div class="form-group">
                <label for="lama_domisili">Lama Domisili <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="lama_domisili" required />
                <!-- <div class="input-group">
                    <input type="number" class="form-control" id="lama_domisili" name="lama_domisili" placeholder="Lama Domisili" required />
                    <div class="input-group-addon">Tahun</div>
                </div> -->
            </div>
            <div class="form-group">
                <label for="alamat_domisili">Alamat Domisili <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alamat_domisili" name="alamat_domisili" placeholder="Alamat Domisili" required />
            </div>
            <div class="form-group">
                <label for="alamat_ktp">Alamat KTP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp" placeholder="Alamat KTP" required />
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
                <input type="hidden" id="warga_id_hidden" name="warga_id_hidden" />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<form id="form_warga">
    <div class="modal fade" id="modal_warga" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Warga</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="warga_keyword">Nama Warga</label>
                        <input type="text" class="form-control" id="warga_keyword" name="warga_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_warga">
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
<script src="create_vitamin.js"></script>