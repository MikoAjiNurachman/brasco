  <?php $role = "inventory" ?>

  <?php
  session_start();
  $title = "Hasil Stock Opname";
  $id = $_SESSION['admin']['id'];
  include '../env.php';
  cekAdmin($role);
  if (isset($_POST['simpan'])) {
    $counter = mysqli_fetch_array(mysqli_query($conn, "SELECT header,digit FROM counter WHERE tabel='stock_opname'"));
    $st = $counter['header'];
    $dg = $counter['digit'];
    $dg++;
    $char = $st . "-" . sprintf("%08s", $dg);
    $sql = '';
    for ($i = 0; $i < $_POST['total']; $i++) {
      $barcode = $_POST['barcode'][$i];
      $qty = $_POST['qty'][$i];
      $inven = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity FROM inventory WHERE barcode='$barcode'"));
      $qty_selisih = $inven['quantity']-$qty;
      $sql .="UPDATE inventory SET quantity='$qty' WHERE barcode='$barcode';";
      $sql  .= "INSERT INTO stock_opname(id,kode,barcode_inventory,quantity_opname,quantity_selisih,id_admin,id_edit_admin) VALUES(null,'$char','$barcode','$qty','$qty_selisih','$id','0');";
    }
    $angka = explode("-", $char)[1];
    $update = query("UPDATE counter SET digit='$angka' WHERE tabel='stock_opname'");
    $query = mysqli_multi_query($conn, $sql);
   if ($query == true) {
    echo "<script>
    location = 'index.php'
    </script>";
   }
  }
  if (isset($_POST['cariBarcode'])) {
    extract($_POST);
    $query = "SELECT * FROM inventory WHERE barcode BETWEEN '$barcode1' AND '$barcode2'";
    $result = mysqli_query($conn,$query);
  }
  ?>
  <script>
    var active = 'header_stock';
    var active_2 = 'header_stock_input';
  </script>
  <!-- =============================================== -->
  <?php include('../templates/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        FORM INPUT HASIL STOCK OPNAME
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">FORM INPUT HASIL STOCK OPNAME</h3> -->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="container">
            <div class="">
              <form action="" method="post" class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <!-- <label>Barcode</label>
                  <input type="text" name="barcode1">
                  <label>s/d</label>
                  <input type="text" name="barcode2"> -->
                    <label for="" class="col-xs-1 control-label">Barcode</label>
                    <div class="col-xs-3">
                      <select name="barcode1" class="form-control">
                        <option selected disabled>Barcode</option>
                        <?php
                        $query = mysqli_query($conn,"SELECT * FROM inventory");
                        foreach ($query as $data) {
                          ?>
                          <?php if (is_numeric($data['barcode'])) : ?>
                            <option value="<?= $data['barcode'] ?>"><?= $data['barcode'] ?> - <?= $data['nama_barang'] ?></option>
                          <?php else : ?>

                          <?php endif; ?>
                        <?php } ?>
                      </select>
                    </div>
                    <label for="" class="col-xs-1 control-label">s/d</label>
                    <div class="col-xs-3">
                      <select name="barcode2" class="form-control">
                        <option selected disabled>Barcode</option>
                        <?php
                        $query = mysqli_query($conn,"SELECT * FROM inventory");
                        foreach ($query as $data) {
                          ?>
                          <?php if (is_numeric($data['barcode'])) : ?>
                            <option value="<?= $data['barcode'] ?>"><?= $data['barcode'] ?> - <?= $data['nama_barang'] ?></option>
                          <?php else : ?>

                          <?php endif; ?>
                        <?php } ?>
                      </select>
                    </div>
                    <button class="btn btn-info" type="submit" name="cariBarcode">Search</button>
                    <?php if (isset($_POST['cariBarcode'])) : ?>
                      <a target="_blank" href="stock_opname/laporan.php?<?= "barcode1=$barcode1&barcode2=$barcode2" ?>" class="btn btn-success">Print</a>
                    <?php endif; ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <form action="" method="POST" class="form-vertical">
            <div class="table-responsive">
              <table class=" table table-bordered table-striped" id="">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Barcode</th>
                    <th>Nama Item</th>
                    <th>Sat</th>
                    <th>QTY Opname</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($result)) : ?>
                    <?php $i = 1;
                      foreach ($result as $res) :
                        $satuan = mysqli_query($conn,"SELECT satuan FROM satuan WHERE id='$res[satuan]'");
                        foreach ($satuan as $asSatuan) {
                          ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $res['barcode'] ?></td>
                          <input type="hidden" name="barcode[]" value="<?= $res['barcode'] ?>">
                          <td><?= $res['nama_barang'] ?></td>
                          <td><?= $asSatuan['satuan'] ?></td>
                          <td><input style="width:30px;text-align:center" type="text" name="qty[]"></td>

                        </tr>
                    <?php $i++;
                        }
                      endforeach; ?>
                    <input type="hidden" name="total" value="<?= --$i ?>">
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div style="float: right; padding-top: 50px">
              <button class="btn btn-primary" name="simpan" type="submit">Save</button>
          </form>

        </div>
      </div>



  </div>
  <!-- /.box-body -->
  <!--  <div class="box-footer">
            Footer
          </div> -->
  <!-- /.box-footer-->
  <!-- </div> -->
  <!-- /.box -->

  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include('../templates/footer.php') ?>
  <script type="text/javascript">
    // $('#simpan').click(() => {
    //   var barcode = $('#barcode').val()
    //   var qty = $('#qty').val()
    //   $.post('stock_opname/save.php', {
    //     'barcode': barcode,
    //     'qty': qty
    //   }, (response) => {
    //     console.log(response)
    //   })
    // })
  </script>