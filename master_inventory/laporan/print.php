<?php include('../../env.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Master Inventory</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Data Master Inventory</h1>
    <table class="table table-bordered table-stripped" style="margin-top: 30px;">
        <thead>
            <tr>
                <th>No</th>
                <th>BARCODE</th>
                <th>NAMA</th>
                <th>SAT</th>
                <th>TIPE BARANG</th>
                <th>HARGA JUAL 1</th>
                <th>HARGA JUAL 2</th>
                <th>HARGA JUAL 3</th>
            </tr>
        </thead>
        <tbody>
            <?php $query = $conn->query("SELECT * FROM inventory WHERE id = '$_GET[id]' "); 
            $i = 1;
            while ($p = $query->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $p['barcode'] ?></td>
                <?php
                    $id_tipe = $p['id_tipe_barang'];
                    $result = query("SELECT * FROM tipe_barang WHERE id = '$id_tipe'");
                    $id_satuan = $p['satuan'];
                    $result2 = query("SELECT * FROM satuan WHERE id = '$id_satuan'");
                ?>
                <td><?php echo $p['nama_barang'] ?></td>
                <td><?php echo $result2[0]['satuan'] ?></td>
                <td><?php echo $result[0]['nama_barang'] ?></td>
                <td><?php echo $p['harga_jual1'] ?></td>
                <td><?php echo $p['harga_jual2'] ?></td>
                <td><?php echo $p['harga_jual3']?></td>
            </tr>
            <?php endwhile; ?>
            <?php $i++; ?>
        </tbody>
    </table>

    <script>
        function printWindow(){
            window.print();
            CheckWindowState();
        }
        function CheckWindowState(){
            if(document.readyState=="complete"){
                window.close();
            }
            else{
                setTimeout("CheckWindowState()", 11000);
            }
        }
        printWindow();
    </script>

</body>
</html>