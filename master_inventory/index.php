<?php $role = "inventory" ?>

<?php
require 'functions.php';
if (isset($_POST["submit"])) {
  if (tambah($_POST) > 0) {
    echo "
      <script>
        alert('Data Berhasil Ditambahkan!');
        document.location.href = 'index.php';
      </script>
      ";
  } else {
    echo "  
      <script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'index.php';
      </script>
      ";
  }
}
$data = [];
$data = query("SELECT * FROM inventory");

$title = "Master Inventory";
?>
<script>
  var active = 'header_inventory';
  var active_2 = 'header_inventory_master';
</script>
<?php include('../templates/header.php') ?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- <section class="content-header">
        <h1>
          Master Inventori
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Examples</a></li>
          <li class="active">Blank page</li>
        </ol>
      </section> -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <h1>MASTER INVENTORY</h1>
        <div class="border bg-light " style="width: 100%; margin-bottom: 20px;">
          <div class="border bg-light " style="width: 100%; margin-bottom: 20px;">
            <!-- <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Informasi </h4>
              Pastikan Barcode sudah dibuat dan disetujui <br>
              Harap Cek Duplikasi Barcode sebelum lanjut ke langkah berikutnya
            </div> -->
          </div>
        </div>
        <form class="inline-form" action="" method="post" id="form_simpan">
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-2" style="padding: 5px;">
                <input type="hidden" id="status" value="">
                <input type="number" id="isi_barcode" name="barcode" class="form-control" placeholder="Barcode . . ." required>
              </div>
              <!-- <div class="col-sm-2" style="padding: 5px;">
                <button type="button" class="btn btn-danger" id="barcode_inv">Cek Duplikasi</button>
              </div> -->
              <div class="col-sm-4" style="padding: 5px;">
                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang . . ." required>
              </div>
              <div class="col-sm-2" style="padding: 5px;">
                <select class="form-control" name="satuan">
                  <option disabled selected>Satuan</option>

                  <?php
                  $datat = query("SELECT * FROM satuan");
                  foreach ($datat as $datas) :
                  ?>
                    <option value="<?= $datas['id'] ?>"><?= $datas['satuan'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-2" style="padding: 5px;">
                <select class="form-control" name="id_tipe_barang">
                  <option disabled selected>Tipe Barang</option>
                  <?php
                  $datat = cariBarang();
                  foreach ($datat as $datas) :
                  ?>

                    <option value="<?= $datas['id'] ?>"><?= $datas['nama_barang'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-3" style="padding: 5px;">
                <input type="number" min="0" class="form-control" name="harga_jual1" placeholder="Harga Jual 1 . . ." required>
              </div>
              <div class="col-sm-3" style="padding: 5px;">
                <input type="number" min="0" class="form-control" name="harga_jual2" placeholder="Harga Jual 2 . . ." required>
              </div>
              <div class="col-sm-3" style="padding: 5px;">
                <input type="number" min="0" class="form-control" name="harga_jual3" placeholder="Harga Jual 3 . . ." required>
              </div>
            </div>
            <button type="submit" id="submit" class="btn btn-info pull-right" name="submit">Tambah</button>
          </div>
        </form>
        <div style="width: 100%">
          <div style="border-top: solid; width: 100%; margin-top: 20px">
            <h3 style="margin-top: 20px">LIST MASTER INVENTORY</h3>
          </div>
          <!-- <button type="button" class="btn btn-light">Copy</button>

            <button type="button" class="btn btn-light">CSV</button>
            <button type="button" class="btn btn-light">Excel</button>
            <button type="button" class="btn btn-light">PDF</button>
            <a href="master_inventory/laporan/print.php" class="btn btn-primary">Print</a> -->


        </div>
        <div class="table-responsive" style="margin-top: 20px">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="thead-dark" align="center">
              <tr class="text-center">
                <th>No</th>
                <th>BARCODE</th>
                <th>NAMA</th>
                <th>SAT</th>
                <th>TIPE BARANG</th>
                <!-- <th>HARGA BELI AKHIR</th>


                    <th>TOT BELI AKHIR</th> -->
                <th>HARGA JUAL 1</th>
                <th>HARGA JUAL 2</th>
                <th>HARGA JUAL 3</th>
                <th>STOK</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody align="center">
              <?php $i = 1; ?>
              <?php foreach ($data as $row) :
              ?>

                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row["barcode"]; ?></td>
                  <?php
                  $id_tipe = $row['id_tipe_barang'];
                  $result = query("SELECT * FROM tipe_barang WHERE id = '$id_tipe'");
                  $id_satuan = $row['satuan'];
                  $result2 = query("SELECT * FROM satuan WHERE id = '$id_satuan'");
                  ?>
                  <td><?php echo $row["nama_barang"]; ?></td>
                  <td><?php echo $result2[0]["satuan"]; ?></td>
                  <td><?php echo $result[0]['nama_barang']; ?></td>
                  <td><?php echo $row["harga_jual1"]; ?></td>
                  <td><?php echo $row["harga_jual2"]; ?></td>
                  <td><?php echo $row["harga_jual3"]; ?></td>
                  <td><?php echo $row["quantity"]; ?></td>
                  <td>
                    <a href="master_inventory/ubah.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit fa-lg"></i>&nbsp&nbsp</a>
                    <a href="master_inventory/hapus.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-trash fa-lg text-red">&nbsp&nbsp</i></a>
                    <a href="master_inventory/laporan/print.php?id=<?php echo $row["id"] ?>" target="_blank"><i class="fa fa-print text-green fa-lg"></i></a>
                  </td>
                </tr>
                <?php $i++ ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div style="width: 100%; text-align: right;">
          <button class="btn btn-light">Close</button>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $('#barcode_inv').on('click', function() {
    console.log($('#isi_barcode').val());
    // if ($('#isi_barcode').val() == '') {
    //   alert('Tolong diisi barcodenya');
    //   return;
    // }
    // $.ajax({
    //   url: './master_inventory/cekBarcode.php',
    //   type: 'POST',
    //   data: {
    //     "barcode": $('#isi_barcode').val()
    //   },
    //   complete: function(response, textStatus, jqXHR) {
    //     var respon = JSON.parse(response.responseText);
    //     if (respon.result == 0) {
    //       alert("Barcode bisa digunakan!");
    //     } else {
    //       alert("Barcode tidak bisa digunakan!");
    //     }
    //   },
    //   error: function(jqXHR, textStatus, err) {
    //     console.log(textStatus + err + jqXHR);
    //   }
    // });
  });
  $('#isi_barcode').keyup(function() {
    var data = $('#isi_barcode').val();
    if ($('#isi_barcode').val() == '') {
      $('#isi_barcode').css('border', '1px solid red');
      return;
    }
    $.ajax({
      url: './master_inventory/cekBarcode.php',
      type: 'POST',
      data: {
        "barcode": $('#isi_barcode').val()
      },
      complete: function(response, textStatus, jqXHR) {
        var respon = JSON.parse(response.responseText);
        if (respon.result == 0) {
          $('#isi_barcode').css('border', '1px solid green');
          $('#status').val("0");

        } else {
          $('#isi_barcode').css('border', '1px solid red');
          $('#status').val("1");
        }
      },
      error: function(jqXHR, textStatus, err) {
        console.log(textStatus + err + jqXHR);
      }

    });
  });
  $("#form_simpan").submit((e) => {
    var hasil = $('#status').val();
    if (hasil == 1) {
      alert("Barcode tidak bisa digunakan!");
      e.preventDefault();
      return false;
    }
  });
</script>
<!-- /.content-wrapper -->


<?php include('../templates/footer.php') ?>