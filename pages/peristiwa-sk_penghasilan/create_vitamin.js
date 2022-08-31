let id_print = null;
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

    $('#form').on('submit', function (e) {
        e.preventDefault()
        simpanData()
    })

    $('#btn_print').on('click', e => {
        window.open(`print.php?id=${id_print}`)
    })
})

function simpanData() {
    $.ajax({
        url: `ajax_store_warga.php`,
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