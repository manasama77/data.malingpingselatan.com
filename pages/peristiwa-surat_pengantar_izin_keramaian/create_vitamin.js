let id_print = null;
let arrLingkungan = [];

$(document).ready(() => {
    $('.select2').select2({
        ajax: {
            delay: 250,
            url: `ajax_list_warga.php`,
            dataType: 'json',
            cache: true,
            data: function (params) {
                var queryParameters = {
                    keyword: params.term
                }

                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (item) {
                        return {
                            text: item.nama_warga,
                            id: item.id_warga
                        }
                    })
                };
            }
        },
        width: "element",
        allowClear: true,
        placeholder: 'Cari Warga',
        minimumInputLength: 2,
    })

    $('.datetimepicker').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })

    $('#form').on('submit', function (e) {
        e.preventDefault()
        if (arrLingkungan.length == 0) {
            return Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: "Izin Lingkungan Kosong",
                showConfirmButton: false,
                timer: 2000,
                toast: true
            }).then(e => {
                $('#nama_perwakilan').focus()
            })
        }
        simpanData()
    })

    $('#btn_print').on('click', e => {
        window.open(`print.php?id=${id_print}`)
    })
})

function simpanData() {
    let form = document.querySelector('#form')
    let formData = new FormData(form)

    formData.append('arr_lingkungan', JSON.stringify(arrLingkungan))

    $.ajax({
        url: `ajax_store_warga.php`,
        type: 'post',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: () => {
            $('#btn_simpan').attr('disabled', true)
            $('#btn_print').attr('disabled', true)
        }
    }).fail(e => {
        console.log(e.responseText)
        $('#btn_simpan').prop('disabled', false)
    }).done(e => {
        id_print = e.id
        if (e.code == 200) {
            $('#btn_print').attr('disabled', false)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: e.msg,
                showConfirmButton: false,
                timer: 2000,
                toast: true
            }).then(e => {
                $('#btn_print').trigger('click')
            })
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: e.msg,
                showConfirmButton: false,
                timer: 2000,
                toast: true
            })
            $('#btn_simpan').attr('disabled', false)
            $('#btn_print').attr('disabled', true)
        }
    })


}

function tambahPerwakilan() {
    let namaPerwakilan = $('#nama_perwakilan')

    if (namaPerwakilan.val().length == 0) {
        return $('#nama_perwakilan').focus()
    } else if (arrLingkungan.length == 10) {
        return Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: "List Perwakilan Maksimal 10 orang",
            showConfirmButton: false,
            timer: 2000,
            toast: true
        })
    }

    let dataLingkungan = {
        id: makeId(),
        name: namaPerwakilan.val()
    }

    arrLingkungan.push(dataLingkungan)
    renderListPerwakilan()
    namaPerwakilan.val('').focus()
}

function renderListPerwakilan() {
    let htmlnya = ``;

    if (arrLingkungan.length == 0) {
        htmlnya = `
            <tr>
                <td colspan="2" class="text-center">Tidak ada perwakilan</td>
            </tr>
        `
    } else {
        arrLingkungan.forEach(e => {
            let id = e.id
            let name = e.name
            htmlnya += `
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePerwakilan('${id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td>${name}</td>
            </tr>
            `
        })
    }

    $('#v_list_perwakilan').html(htmlnya)
}

function deletePerwakilan(id) {
    let index = arrLingkungan.findIndex((item) => item.id === id);
    arrLingkungan.splice(index, 1);
    renderListPerwakilan()
}

function makeId(length = 10) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}