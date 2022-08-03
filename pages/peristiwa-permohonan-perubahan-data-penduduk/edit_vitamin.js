let id_print = null;
$(document).ready(() => {
  $(".select2").select2({
    ajax: {
      delay: 250,
      url: `ajax_list_warga.php`,
      dataType: "json",
      cache: true,
      data: function (params) {
        var queryParameters = {
          keyword: params.term,
        };
        return queryParameters;
      },
      processResults: function (data) {
        return {
          results: $.map(data.data, function (item) {
            return {
              text: item.nama_warga,
              id: item.id_warga,
            };
          }),
        };
      },
    },
    width: "element",
    allowClear: true,
    placeholder: "Cari Warga",
    minimumInputLength: 2,
  });

  $("#form").on("submit", function (e) {
    e.preventDefault();
    simpanData();
  });

  $("#btn_print").on("click", (e) => {
    window.open(`print.php?id=${id_print}`);
  });

  $("#warga_id").on("change", (e) => {
    let val = $("#warga_id").val();

    console.log(val.length);

    if (val.length == 0) {
      clearDataX();
    } else {
      showDetail(val);
    }
  });

  $("#warga_id").trigger("change");
});

function simpanData() {
  $.ajax({
    url: `ajax_update_warga.php`,
    type: "post",
    dataType: "json",
    data: $("#form").serialize(),
    beforeSend: () => {
      $("#btn_simpan").attr("disabled", true);
      $("#btn_print").attr("disabled", true);
    },
  })
    .fail((e) => {
      $("#btn_simpan").attr("disabled", false);
    })
    .done((e) => {
      id_print = e.id;
      console.log(e);
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

function showDetail(warga_id) {
  $.ajax({
    url: `ajax_detail_warga.php`,
    type: "get",
    dataType: "json",
    data: {
      warga_id: warga_id,
    },
  }).done((e) => {
    if (e.total == 0) {
      clearDataX();
    } else {
      console.log(e);
      $("#x_nama").val(e.data.nama_warga);
      $("#x_nik").val(e.data.nik);
      $("#x_tempat").val(e.data.tempat);
      $("#x_tanggal_lahir").val(e.data.tanggal_lahir);
      $("#x_jenis_kelamin").val(e.data.jenis_kelamin);
      $("#x_warganegara").val(e.data.warganegara);
      $("#x_status_perkawinan").val(e.data.status_perkawinan);
      $("#x_agama").val(e.data.agama);
      $("#x_pekerjaan").val(e.data.pekerjaan);
      $("#x_alamat").val(e.data.alamat);

      //   $("#nama").val(e.data.nama_warga);
      //   $("#nik").val(e.data.nik);
      //   $("#tempat").val(e.data.tempat);
      //   $("#tanggal_lahir").val(e.data.tanggal_lahir);
      //   $("#jenis_kelamin").val(e.data.jenis_kelamin);
      //   $("#warganegara").val(e.data.warganegara);
      //   $("#status_perkawinan").val(e.data.status_perkawinan);
      //   $("#agama").val(e.data.agama);
      //   $("#pekerjaan").val(e.data.pekerjaan);
      //   $("#alamat").val(e.data.alamat);
    }
  });
}

function clearDataX() {
  $("#x_nama").val("");
  $("#x_nik").val("");
  $("#x_ttl").val("");
  $("#x_jenis_kelamin").val("");
  $("#x_warganegara").val("");
  $("#x_status_perkawinan").val("");
  $("#x_agama").val("");
  $("#x_pekerjaan").val("");
  $("#x_alamat").val("");

  //   $("#nama").val("");
  //   $("#nik").val("");
  //   $("#tempat").val("");
  //   $("#tanggal_lahir").val("");
  //   $("#jenis_kelamin").val("");
  //   $("#warganegara").val("");
  //   $("#status_perkawinan").val("");
  //   $("#agama").val("");
  //   $("#pekerjaan").val("");
  //   $("#alamat").val("");
}
