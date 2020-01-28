<?php $role = "utility" ?>

<?php
require '../env.php';
if (isset($_POST['submit'])) {
    extract($_POST);
    $sql = "UPDATE jurnal_referensi SET kas='${kas}', bank = '${bank}', umbeli = '${umbeli}', hutang = '${hutang}', persediaan = '${persediaan}', ppnmasuk = '${ppnmasuk}', ongkirbeli = '${ongkirbeli}', umjual = '${umjual}', piutang = '${piutang}', penjualan = '${penjualan}', ppnkeluar = '${ppnkeluar}', ongkirjual = '${ongkirjual}', hpp = '${hpp}', retur_penjualan = '${retur_penjualan}' WHERE id = 1;";
    $query = mysqli_query($conn, $sql);
    lanjutkan($query, "Diupdate!");
}
$title = "Jurnal Referensi";
$dataAkun = query("SELECT * FROM ms_akun");
$dataJurnal = query("SELECT * FROM jurnal_referensi")[0];

?>
<script>
    var active = 'header_jurnal';
</script>

<?php include('../templates/header.php') ?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Blank page
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="container">
                    <h1>
                        <center>-- INFORMASI JURNAL REFERENSI --</center>
                    </h1>
                    <br />
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu1">Jurnal Ref Pembelian</a></li>
                        <li><a data-toggle="tab" href="#menu5">Jurnal Ref Penjualan</a></li>
                        <li><a data-toggle="tab" href="#menu6">Setting Jurnal Ref Penjualan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <br>
                            <table class=" table table-hover table-bordered  display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Pembelian</th>
                                        <th></th>
                                        <th>Akun</th>
                                        <th>Nrml</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>Uang Muka Pembelian</td>
                                        <td>Jurnal 1</td>
                                        <td>Uang Muka Beli</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Kas</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Bank</td>
                                        <td>K</td>
                                    </tr>

                                    <style media="screen">
                                        .wow {
                                            opacity: 0;
                                        }
                                    </style>
                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>



                                    <tr>
                                        <td>Pembelian</td>
                                        <td>Jurnal 2</td>
                                        <td>Persediaan</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ppn beli</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ongkir beli</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Hutang</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Bila ada uang muka =></td>
                                        <td></td>
                                        <td>Hutang</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Uang Muka beli</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Pelunasan</td>
                                        <td>Jurnal 3</td>
                                        <td>Hutang</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Kas</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Bank</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Retur Pembelian</td>
                                        <td>Jurnal 4</td>
                                        <td>Hutang</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Persediaan</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ppn Beli</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ongkir Beli</td>
                                        <td>K</td>
                                    </tr>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Pembelian</th>
                                        <th></th>
                                        <th>Akun</th>
                                        <th>Nrml</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <!-- Jurnal Referensi Penjualan -->
                            <br>
                            <table class=" table table-bordered table-hover display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Penjualan</th>
                                        <th></th>
                                        <th>Akun</th>
                                        <th>Nrml</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>Uang Muka Penjualan</td>
                                        <td>Jurnal 1</td>
                                        <td>Kas</td>
                                        <td>D</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Bank</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>UM Jual</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Penjualan</td>
                                        <td>Jurnal 2</td>
                                        <td>Piutang</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>HPP</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Penjualan</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>PPN Jual</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ongkir</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Persediaan</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Bila ada uang Muka =></td>
                                        <td></td>
                                        <td>UM Jual</td>
                                        <td>D</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Piutang</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>

                                    <tr>
                                        <td>Pelunasan</td>
                                        <td>Jurnal 3</td>
                                        <td>Kas</td>
                                        <td>D</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Bank</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Piutang</td>
                                        <td>K</td>
                                    </tr>

                                    <tr>
                                        <td colspan="8" class="wow">-</td>
                                    </tr>


                                    <tr>
                                        <td>Retur Penjualan</td>
                                        <td>Jurnal 4</td>
                                        <td>Penjualan</td>
                                        <td>D</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ppn jual</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Ongkir Jual</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Piutang</td>
                                        <td>K</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Persediaan</td>
                                        <td>D</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>HPP</td>
                                        <td>K</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Penjualan</th>
                                        <th></th>
                                        <th>Akun</th>
                                        <th>Nrml</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <form class="" action="" method="post">
                                <!-- Setup Penjualan -->
                                <table class=" table table-bordered table-striped display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Akun</th>
                                            <th>No Akun</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employee_data">

                                        <tr>
                                            <td>1</td>
                                            <td>Kas</td>
                                            <td>

                                                <select name="kas" class="form-control select2" required id="kas" width="100%">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['kas']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['kas']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Bank</td>
                                            <td>


                                                <select name="bank" class="form-control select2" required id="bank">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['bank']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['bank']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Uang muka beli</td>
                                            <td>


                                                <select name="umbeli" class="form-control select2" required id="umbeli">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['umbeli']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['umbeli']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Hutang</td>
                                            <td>


                                                <select name="hutang" class="form-control select2" required id="hutang">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['hutang']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['hutang']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Persediaan</td>
                                            <td>


                                                <select name="persediaan" class="form-control select2" required id="persediaan">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['persediaan']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['persediaan']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Ppn masuk</td>
                                            <td>


                                                <select name="ppnmasuk" class="form-control select2" required id="ppnmasuk">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['ppnmasuk']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['ppnmasuk']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Ongkir beli</td>
                                            <td>


                                                <select name="ongkirbeli" class="form-control select2" required id="ongkirbeli">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['ongkirbeli']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['ongkirbeli']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Umjual</td>
                                            <td>


                                                <select name="umjual" class="form-control select2" required id="umjual">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['umjual']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['umjual']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Piutang</td>
                                            <td>


                                                <select name="piutang" class="form-control select2" required id="piutang">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['piutang']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['piutang']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Penjualan</td>
                                            <td>


                                                <select name="penjualan" class="form-control select2" required id="penjualan">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['penjualan']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['penjualan']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Ppn keluar</td>
                                            <td>


                                                <select name="ppnkeluar" class="form-control select2" required id="ppnkeluar">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['ppnkeluar']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['ppnkeluar']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Ongkirjual</td>
                                            <td>


                                                <select name="ongkirjual" class="form-control select2" required id="ongkirjual">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['ongkirjual']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['ongkirjual']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>Hpp</td>
                                            <td>


                                                <select name="hpp" class="form-control select2" required id="hpp">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['hpp']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['hpp']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>Retur Penjualan</td>
                                            <td>


                                                <select name="retur_penjualan" class="form-control select2" required id="retur_penjualan">
                                                    <?php foreach ($dataAkun as $data) : ?>
                                                        <option <?= ($data['kodeakun'] == $dataJurnal['retur_penjualan']) ? 'selected' : ''  ?> value="<?= $data['kodeakun'] ?>"><?= ($data['kodeakun'] == $dataJurnal['retur_penjualan']) ? $res =  $data['kodeakun'] . ' - ' . $data['namaakun'] : $data['kodeakun'] . ' - ' . $data['namaakun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class='pull-right'><button type='button' class='btn bg-maroon btn-flat'><?= $res ?></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Akun</th>
                                            <th>No Akun</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="pull-right">
                                    <button class="btn btn-info" type="submit" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../templates/footer.php') ?>