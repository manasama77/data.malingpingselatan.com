<?php


function logs($warga_id, $jenis_permohonan, $no_surat, $table_name, $table_id)
{
    require 'config/koneksi.php';

    $obj_dt = new DateTime('now');

    $current_d  = $obj_dt->format('Y-m-d');
    $current_dt = $obj_dt->format('Y-m-d H:i:s');
    $sql_count  = "SELECT count(*) as total FROM logs WHERE DATE(created_at) = '$current_d' AND deleted_at is null AND warga_id = '$warga_id' AND jenis_permohonan = '$jenis_permohonan' AND no_surat = '$no_surat'";
    $query_count = mysqli_query($db, $sql_count);
    $data_count = mysqli_fetch_assoc($query_count);
    $total = $data_count['total'];

    if ($total == 0) {
        // store
        $sql_insert = "INSERT INTO logs 
        (
            warga_id,
            table_name,
            table_id,
            jenis_permohonan,
            no_surat,
            deleted_at,
            created_at,
            updated_at
        )
        VALUES
        (
            '$warga_id',
            '$table_name',
            '$table_id',
            '$jenis_permohonan',
            '$no_surat',
            null,
            '$current_dt',
            '$current_dt'
        )
        ";

        mysqli_query($db, $sql_insert);
    }
}
