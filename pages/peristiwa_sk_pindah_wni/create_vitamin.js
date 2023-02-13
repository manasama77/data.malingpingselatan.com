let id_print = null;
let arrPendatang = [];
let alasanPindah = $("#alasan_pindah");
let alasanPindahLainnya = $("#alasan_pindah_lainnya");
let alasanPindahLainnyaGroup = $(".alasan_pindah_lainnya_group");

$(document).ready(() => {
  alasanPindah.on("change", function () {
    if (alasanPindah.val() == 7) {
      alasanPindahLainnyaGroup.show();
      alasanPindahLainnya.attr("required", true);
    } else {
      alasanPindahLainnyaGroup.hide();
      alasanPindahLainnya.attr("required", false);
    }
  });

  $("#form").on("submit", function (e) {
    e.preventDefault();
    if (arrPendatang.length == 0) {
      return Swal.fire({
        position: "top-end",
        icon: "warning",
        title: "Data Pendatang tidak boleh kosong",
        showConfirmButton: false,
        timer: 2000,
        toast: true,
      }).then((e) => {
        $("#nik_pendatang").focus();
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

  formData.append("arr_pendatang", JSON.stringify(arrPendatang));

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

function tambahData() {
  let nikPendatang = $("#nik_pendatang");
  let namaPendatang = $("#nama_pendatang");
  let tempatLahirPendatang = $("#tempat_lahir_pendatang");
  let tanggal_lahir_pendatang = $("#tanggal_lahir_pendatang");
  let shdk_pendatang = $("#shdk_pendatang");

  if (nikPendatang.val().length == 0) {
    return nikPendatang.focus();
  } else if (namaPendatang.val().length == 0) {
    return namaPendatang.focus();
  } else if (tempatLahirPendatang.val().length == 0) {
    return tempatLahirPendatang.focus();
  } else if (tanggal_lahir_pendatang.val().length == 0) {
    return tanggal_lahir_pendatang.focus();
  } else if (shdk_pendatang.val().length == 0) {
    return shdk_pendatang.focus();
  }

  let dataPendatang = {
    id: makeId(),
    nik_pendatang: nikPendatang.val(),
    nama_pendatang: namaPendatang.val(),
    tempat_lahir_pendatang: tempatLahirPendatang.val(),
    tanggal_lahir_pendatang: tanggal_lahir_pendatang.val(),
    shdk_pendatang: shdk_pendatang.val(),
  };

  arrPendatang.push(dataPendatang);
  renderList();
  nikPendatang.val("").focus();
  namaPendatang.val("");
  tempatLahirPendatang.val("");
  tanggal_lahir_pendatang.val("");
  shdk_pendatang.val("");
}

function renderList() {
  let htmlnya = ``;

  if (arrPendatang.length == 0) {
    htmlnya = `
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
        `;
  } else {
    arrPendatang.forEach((e) => {
      let id = e.id;
      let nik_pendatang = e.nik_pendatang;
      let nama_pendatang = e.nama_pendatang;
      let tempat_lahir_pendatang = e.tempat_lahir_pendatang;
      let tanggal_lahir_pendatang = e.tanggal_lahir_pendatang;
      let shdk_pendatang = e.shdk_pendatang;
      htmlnya += `
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteKayu('${id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td>${nik_pendatang}</td>
                <td>${nama_pendatang}</td>
                <td>${tempat_lahir_pendatang}, ${tanggal_lahir_pendatang}</td>
                <td>${shdk_pendatang}</td>
            </tr>
            `;
    });
  }

  $("#v_list").html(htmlnya);
}

function deleteKayu(id) {
  let index = arrPendatang.findIndex((item) => item.id === id);
  arrPendatang.splice(index, 1);
  renderList();
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
