let id_print = null;
$(document).ready(() => {
    $('#form').on('submit', function (e) {
        e.preventDefault()
        if ($('#ayah_id').val().length == 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Pilih Warga yang Bekerja',
                showConfirmButton: false,
                timer: 2000,
                toast: true
            }).then(() => $('#btn_modal_ayah').trigger('click'))
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

function vListAyahDefault() {
    $('#v_list_ayah').html(defaultListWarga)
}

// AYAH START
$('#btn_modal_ayah').on('click', e => {
    e.preventDefault()
    $('#modal_ayah').modal('show')
})

$('#modal_ayah').on('shown.bs.modal', function () {
    $('#ayah_keyword').focus()
})

$('#ayah_keyword').on('keyup', () => {
    const ayahKeyword = $('#ayah_keyword').val()
    if (ayahKeyword.length >= 3) {
        findAyah(ayahKeyword)
    }
})

$('#form_ayah').on('submit', e => {
    e.preventDefault()
})

function findAyah(ayahKeyword) {
    $.ajax({
        url: `ajax_list_ayah.php`,
        type: 'get',
        dataType: 'json',
        data: {
            keyword: ayahKeyword
        },
        beforeSend: () => {
            $('#v_list_ayah').html(defaultListWarga)
        }
    }).done(e => {
        if (e.code == 200) {
            if (e.total > 0) {
                let htmlnya = ``
                $.each(e.data, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihAyah(${k.id_warga}, '${k.nama_warga}', '${k.id_keluarga}', '${k.alamat_keluarga}', '${k.rt_warga}', '${k.rw_warga}')"><small>(${k.nik_warga})</small> ${k.nama_warga}</td>
                    </tr>
                    `
                })
                $('#v_list_ayah').html(htmlnya)
            } else {
                vListAyahDefault()
            }
        } else {
            vListAyahDefault()
        }
    })
}

function pilihAyah(id_warga, nama_warga, id_keluarga, alamat_keluarga, rt_warga, rw_warga) {
    $('#ayah_id_hidden').val(id_warga)
    $('#ayah_id').val(nama_warga)
    $('#keluarga_id_hidden').val(id_keluarga)
    $('#alamat').val(alamat_keluarga)
    $('#rt').val(rt_warga)
    $('#rw').val(rw_warga)
    $('#modal_ayah').modal('hide')
}
// AYAH END

// IBU START
$('#btn_modal_ibu').on('click', e => {
    e.preventDefault()
    $('#modal_ibu').modal('show')
})

$('#modal_ibu').on('shown.bs.modal', function () {
    $('#ibu_keyword').focus()
})

$('#ibu_keyword').on('keyup', () => {
    const ibuKeyword = $('#ibu_keyword').val()
    if (ibuKeyword.length >= 3) {
        findIbu(ibuKeyword)
    }
})

$('#form_ibu').on('submit', e => {
    e.preventDefault()
})

function findIbu(ibuKeyword) {
    $.ajax({
        url: `ajax_list_warga.php`,
        type: 'get',
        dataType: 'json',
        data: {
            keyword: ibuKeyword
        },
        beforeSend: () => {
            $('#v_list_ibu').html(defaultListWarga)
        }
    }).done(e => {
        if (e.code == 200) {
            if (e.total > 0) {
                let htmlnya = ``
                $.each(e.data, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td role="button" onclick="pilihIbu(${k.id_warga}, '${k.nama_warga}')"><small>(${k.nik_warga})</small> ${k.nama_warga}</td>
                    </tr>
                    `
                })
                $('#v_list_ibu').html(htmlnya)
            } else {
                vListIbuDefault()
            }
        } else {
            vListIbuDefault()
        }
    })
}

function pilihIbu(id_warga, nama_warga) {
    $('#ibu_id_hidden').val(id_warga)
    $('#ibu_id').val(nama_warga)
    $('#modal_ibu').modal('hide')
}
// IBU END

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
                vListAyahDefault()
            }
        } else {
            vListAyahDefault()
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
    }).fail(() => {
        $('#btn_simpan').attr('disabled', false)
        $('#btn_print').attr('disabled', true)
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