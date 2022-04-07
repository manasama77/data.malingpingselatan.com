let id_print = null;
$(document).ready(() => {
    $('#form').on('submit', function (e) {
        e.preventDefault()
        if ($('#warga_id').val().length == 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Pilih Warga yang Bekerja',
                showConfirmButton: false,
                timer: 2000,
                toast: true
            }).then(() => $('#btn_modal_warga').trigger('click'))
        } else if ($('#pelapor_id').val().length == 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Pilih Pelapor',
                showConfirmButton: false,
                timer: 2000,
                toast: true
            }).then(() => $('#btn_modal_pelapor').trigger('click'))
        } else {
            simpanData()
        }
    })

    $('#btn_print').on('click', e => {
        window.open(`print.php${window.location.search}`)
    })
})

const defaultListWarga = `
<tr>
    <td>Data Tidak Ditemukan</td>
</tr>
`

function vListWargaDefault() {
    $('#v_list_warga').html(defaultListWarga)
}

// WARGA START
$('#btn_modal_warga').on('click', e => {
    e.preventDefault()
    $('#modal_warga').modal('show')
})

$('#modal_warga').on('shown.bs.modal', function () {
    $('#warga_keyword').focus()
})

$('#warga_keyword').on('keyup', () => {
    const wargaKeyword = $('#warga_keyword').val()
    if (wargaKeyword.length >= 3) {
        findWarga(wargaKeyword)
    }
})

$('#form_warga').on('submit', e => {
    e.preventDefault()
})

function findWarga(wargaKeyword) {
    $.ajax({
        url: `ajax_list_warga.php`,
        type: 'get',
        dataType: 'json',
        data: {
            keyword: wargaKeyword
        },
        beforeSend: () => {
            $('#v_list_warga').html(defaultListWarga)
        }
    }).done(e => {
        if (e.code == 200) {
            if (e.total > 0) {
                let htmlnya = ``
                $.each(e.data, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihWarga(${k.id_warga}, '${k.nama_warga}')">${k.nama_warga}</td>
                    </tr>
                    `
                })
                $('#v_list_warga').html(htmlnya)
            } else {
                vListWargaDefault()
            }
        } else {
            vListWargaDefault()
        }
    })
}

function pilihWarga(id_warga, nama_warga) {
    $('#warga_id_hidden').val(id_warga)
    $('#warga_id').val(nama_warga)
    $('#modal_warga').modal('hide')
}
// WARGA END

// PELAPOR START
$('#btn_modal_pelapor').on('click', e => {
    e.preventDefault()
    $('#modal_pelapor').modal('show')
})

$('#modal_pelapor').on('shown.bs.modal', function () {
    $('#pelapor_keyword').focus()
})

$('#pelapor_keyword').on('keyup', () => {
    const pelaporKeyword = $('#pelapor_keyword').val()
    if (pelaporKeyword.length >= 3) {
        findPelapor(pelaporKeyword)
    }
})

$('#form_pelapor').on('submit', e => {
    e.preventDefault()
})

function findPelapor(pelaporKeyword) {
    $.ajax({
        url: `ajax_list_warga.php`,
        type: 'get',
        dataType: 'json',
        data: {
            keyword: pelaporKeyword
        },
        beforeSend: () => {
            $('#v_list_pelapor').html(defaultListWarga)
        }
    }).done(e => {
        if (e.code == 200) {
            if (e.total > 0) {
                let htmlnya = ``
                $.each(e.data, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihPelapor(${k.id_warga}, '${k.nama_warga}')">${k.nama_warga}</td>
                    </tr>
                    `
                })
                $('#v_list_pelapor').html(htmlnya)
            } else {
                vListWargaDefault()
            }
        } else {
            vListWargaDefault()
        }
    })
}

function pilihPelapor(id_warga, nama_warga) {
    $('#pelapor_id_hidden').val(id_warga)
    $('#pelapor_id').val(nama_warga)
    $('#modal_pelapor').modal('hide')
}
// PELAPOR END

function simpanData() {
    $.ajax({
        url: `ajax_update_warga.php`,
        type: 'post',
        dataType: 'json',
        data: $('#form').serialize(),
        beforeSend: () => {
            $('#btn_simpan').attr('disabled', true)
            $('#btn_print').attr('disabled', true)
        }
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