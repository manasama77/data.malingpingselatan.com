let id_print = null;
let arrKayu = [];

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

  $(".datetimepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });

  $("#form").on("submit", function (e) {
    e.preventDefault();
    if (arrKayu.length == 0) {
      return Swal.fire({
        position: "top-end",
        icon: "warning",
        title: "Data kayu tidak boleh kosong",
        showConfirmButton: false,
        timer: 2000,
        toast: true,
      }).then((e) => {
        $("#nama_kayu").focus();
      });
    }
    simpanData();
  });

  $("#btn_print").on("click", (e) => {
    window.open(`print.php?id=${id_print}`);
  });
});

function simpanData() {
  let form = document.querySelector("#form");
  let formData = new FormData(form);

  formData.append("arr_pohon", JSON.stringify(arrKayu));

  $.ajax({
    url: `ajax_store_warga.php`,
    type: "post",
    dataType: "json",
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: () => {
      $("#btn_simpan").attr("disabled", true);
      $("#btn_print").attr("disabled", true);
    },
  })
    .fail((e) => {
      console.log(e.responseText);
      $("#btn_simpan").prop("disabled", false);
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

function tambahKayu() {
  let namaKayu = $("#nama_kayu");
  let jumlahBatang = $("#jumlah_batang");
  let hasilKlem = $("#hasil_klem");
  let keterangan = $("#keterangan");

  if (namaKayu.val().length == 0) {
    return namaKayu.focus();
  } else if (jumlahBatang.val().length == 0) {
    return jumlahBatang.focus();
  } else if (hasilKlem.val().length == 0) {
    return hasilKlem.focus();
  } else if (arrKayu.length == 5) {
    return Swal.fire({
      position: "top-end",
      icon: "warning",
      title: "Data kayu maksimal 10 data",
      showConfirmButton: false,
      timer: 2000,
      toast: true,
    });
  }

  let dataKayu = {
    id: makeId(),
    nama_kayu: namaKayu.val(),
    jumlah_batang: jumlahBatang.val(),
    hasil_klem: hasilKlem.val(),
    keterangan: keterangan.val(),
  };

  arrKayu.push(dataKayu);
  renderListKayu();
  namaKayu.val("").focus();
  jumlahBatang.val("");
  hasilKlem.val("");
  keterangan.val("");
}

function renderListKayu() {
  let htmlnya = ``;

  if (arrKayu.length == 0) {
    htmlnya = `
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
        `;
  } else {
    arrKayu.forEach((e) => {
      let id = e.id;
      let nama_kayu = e.nama_kayu;
      let jumlah_batang = e.jumlah_batang;
      let hasil_klem = e.hasil_klem;
      let keterangan = e.keterangan;
      htmlnya += `
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteKayu('${id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td>${nama_kayu}</td>
                <td>${jumlah_batang}</td>
                <td>${hasil_klem}</td>
                <td>${keterangan}</td>
            </tr>
            `;
    });
  }

  $("#v_list").html(htmlnya);
}

function deleteKayu(id) {
  let index = arrKayu.findIndex((item) => item.id === id);
  arrKayu.splice(index, 1);
  renderListKayu();
}

function makeId(length = 10) {
  var result = "";
  var characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}
