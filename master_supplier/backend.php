<?php $role = "procurement" ?>
<?php
include '../env.php';
extract($_POST);
if ($params == 1) {
    $json = array();
    $arr = array();
    $tanggal_tempo = query("SELECT * FROM purchasing WHERE tanggal_jatuh_tempo BETWEEN '$tanggal_satu' AND '$tanggal_dua'");
    foreach ($tanggal_tempo as $purchasing) {
        $arr['invoice'] = $purchasing['no_invoice'];
        $arr['kode'] = $purchasing['no_invoice'];
        $kode_pu = $arr['kode'];
        $arr['tanggal_jatuh_tempo'] = $purchasing['tanggal_jatuh_tempo'];
        $tanggal_now = date('Y-m-d', strtotime('now'));
        $tiga_puluh = date('Y-m-d', strtotime('-30 days'));
        $enam_puluh = date('Y-m-d', strtotime('-60 days'));
        $sembilan_puluh = date('Y-m-d', strtotime('-90 days'));
        $kode = $purchasing['kode_supplier'];
        if ($arr['tanggal_jatuh_tempo'] > $tanggal_now) {
            $puItem = query("SELECT quantity_terima,harga_satuan FROM purchasing_item WHERE kode_pu='$kode_pu'");
            foreach ($puItem as $total) {
                if (isset($arr['belum_jatuh_tempo'])) {
                    $arr['belum_jatuh_tempo'] += $total['quantity_terima'] * $total['harga_satuan'];
                } else {
                    $arr['belum_jatuh_tempo']  = $total['quantity_terima'] * $total['harga_satuan'];
                }
                $arr['satu_bulan'] = "-";
                $arr['dua_bulan'] = "-";
                $arr['tiga_bulan'] = "-";
                $arr['lebih_dari_tiga_bulan'] = "-";
            }
        } elseif ($arr['tanggal_jatuh_tempo'] < $tanggal_now) {
            $puItem = query("SELECT quantity_terima,harga_satuan FROM purchasing_item WHERE kode_pu='$kode_pu'");
            foreach ($puItem as $total) {
                if ($arr['tanggal_jatuh_tempo'] > $tiga_puluh && $arr['tanggal_jatuh_tempo'] < $tanggal_now) {
                    if (isset($arr['satu_bulan'])) {
                        $arr['satu_bulan'] += $total['quantity_terima'] * $total['harga_satuan'];
                    } else {
                        $arr['satu_bulan']  = $total['quantity_terima'] * $total['harga_satuan'];
                    }
                }
                if ($arr['tanggal_jatuh_tempo'] > $enam_puluh && $arr['tanggal_jatuh_tempo'] < $tiga_puluh) {
                    if (isset($arr['dua_bulan'])) {
                        $arr['dua_bulan'] += $total['quantity_terima'] * $total['harga_satuan'];
                    } else {
                        $arr['dua_bulan']  = $total['quantity_terima'] * $total['harga_satuan'];
                    }
                }
                if ($arr['tanggal_jatuh_tempo'] > $sembilan_puluh && $arr['tanggal_jatuh_tempo'] < $enam_puluh) {
                    if (isset($arr['tiga_bulan'])) {
                        $arr['tiga_bulan'] += $total['quantity_terima'] * $total['harga_satuan'];
                    } else {
                        $arr['tiga_bulan']  = $total['quantity_terima'] * $total['harga_satuan'];
                    }
                }
                if ($arr['tanggal_jatuh_tempo'] < $sembilan_puluh) {
                    if (isset($arr['lebih_dari_tiga_bulan'])) {
                        $arr['lebih_dari_tiga_bulan'] += $total['quantity_terima'] * $total['harga_satuan'];
                    } else {
                        $arr['lebih_dari_tiga_bulan']  = $total['quantity_terima'] * $total['harga_satuan'];
                    }
                }
            }
        }
        $kode_sup = query("SELECT * FROM supplier WHERE kode = '$kode'");
        foreach ($kode_sup as $supplier) {
            $arr['nama_supplier'] = $supplier['nama'];
        }
        array_push($json, $arr);
    }
    echo json_encode($json);
}
if ($params == 2) {
    extract($_POST);
    $array = array();
    $json = array();
    $query1 = query("SELECT * FROM purchasing WHERE kode_supplier BETWEEN '$kode_sup1' AND '$kode_sup2'");
    foreach ($query1 as $purchasing) {
        $invoice = $purchasing['kode'];
        $array['kode_supplier'] = $purchasing['kode_supplier'];
        $kode_supplier = $array['kode_supplier'];
        $array['invoice'] = $invoice;
        $array['tanggal_jatuh_tempo'] = $purchasing['tanggal_jatuh_tempo'];
        $tanggal_now = date('Y-m-d', strtotime('now'));
        $satu_tahun = date('Y-m-d', strtotime('-1 years'));
        $dua_tahun = date('Y-m-d', strtotime('-2 years'));
        $tiga_tahun = date('Y-m-d', strtotime('-3 years'));
        $query = query("SELECT * FROM supplier WHERE kode = '$kode_supplier'");
        foreach ($query as $supplier) {
            $array['nama_supplier'] = $supplier['nama'];
            $array['saldo_awal'] = $supplier['saldo_awal'];
            $array['saldo_jalan'] = $supplier['saldo_jalan'];
        }
        $query2 = query("SELECT * FROM purchasing_item WHERE kode_pu = '$invoice'");
        foreach ($query2 as $item) {
            if ($array['tanggal_jatuh_tempo'] >= $tanggal_now) {
                if (isset($array['nol_tahun'])) {
                    $array['nol_tahun'] += $item['quantity_terima'] * $item['harga_satuan'];
                } else {
                    $array['nol_tahun']  = $item['quantity_terima'] * $item['harga_satuan'];
                }
                $array['satu_tahun'] = "-"; //lu tadi blom include anjay
                $array['dua_tahun'] = "-";
                $array['tiga_tahun'] = "-";
            }
            if ($array['tanggal_jatuh_tempo'] > $satu_tahun && $array['tanggal_jatuh_tempo'] < $tanggal_now) {
                if (isset($array['satu_tahun'])) {
                    $array['satu_tahun'] += $item['quantity_terima'] * $item['harga_satuan'];
                } else {
                    $array['satu_tahun']  = $item['quantity_terima'] * $item['harga_satuan'];
                }
            }
            if ($array['tanggal_jatuh_tempo'] > $dua_tahun && $array['tanggal_jatuh_tempo'] < $satu_tahun) {
                if (isset($array['dua_tahun'])) {
                    $array['dua_tahun'] += $item['quantity_terima'] * $item['harga_satuan'];
                } else {
                    $array['dua_tahun']  = $item['quantity_terima'] * $item['harga_satuan'];
                }
            }
            if ($array['tanggal_jatuh_tempo'] > $tiga_tahun && $array['tanggal_jatuh_tempo'] < $dua_tahun) {
                if (isset($array['tiga_tahun'])) {
                    $array['tiga_tahun'] += $item['quantity_terima'] * $item['harga_satuan'];
                } else {
                    $array['tiga_tahun']  = $item['quantity_terima'] * $item['harga_satuan'];
                }
            }
        }
        array_push($json, $array);
    }
    echo json_encode($json);
}
