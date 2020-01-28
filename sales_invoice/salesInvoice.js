var switch2 = false;
var field = "kode";
var url = window.location.href;
var link = "sales_invoice/ajax.php";
var subtotal = 0;
var ppnTotal = 0;
var ongkir = 0;
var switch3 = false;
var packing = [];

if (url.indexOf("?" + field + "=") != -1) {
  var url = new URL(url);
  var c = url.searchParams.get("kode");
  ajax(c);
  switch2 = true;
} else if (url.indexOf("&" + field + "=") != -1) {
  var url = new URL(url);
  var c = url.searchParams.get("kode");
  ajax(c);
  switch2 = true;
}

function tampilkan(kode) {
  document.location.search = `kode=${kode}`;
}

$("#tipe_ppn").click(e => {
  if (switch3 === false) {
    e.preventDefault();
    alert("Tolong dipilih Itemnya!");
    return false;
  }
});

$("#tipe_ppn").change(() => {
  var ppn = $("#tipe_ppn :selected").val();
  if (ppn == "t") {
    var hasil = 0;
    $("#ppn").val(parseInt(hasil));
  }
  if (ppn == "i") {
    var hasil = (((subtotal * 10) / 11) * 10) / 100;
    $("#ppn").val(parseInt(hasil));
  }
  if (ppn == "e") {
    var hasil = (subtotal * 10) / 100;
    $("#ppn").val(parseInt(hasil));
  }
  ppnTotal = parseInt(hasil);
  hitungTotal();
});

function hitungTotal() {
  var total = subtotal + ppnTotal + ongkir;
  $("#total").val(total);
}

$("#formInvoice").submit(e => {
  var on1 = $("#ongkir").val();
  var on2 = $("#suratJalan").prop("checked");
  var on3 = $("#kwitansi").prop("checked");
  var on4 = $("#ppn").val();

  if (on1 == "") {
    alert("Tolong diisi Ongkirnya, kalau tidak ada diberi angka 0");
    e.preventDefault();
    return false;
  }
  if (on4 == "") {
    alert("Tolong dipilih PPN");
    e.preventDefault();
    return false;
  }
  if (!on2 && !on3) {
    alert("Tolong dicentang Surat Jalan atau Kwitansi");
    e.preventDefault();
    return false;
  }
});

$("#ongkir").keyup(() => {
  if ($("#ongkir").val() == "") {
    ongkir = 0;
  } else {
    ongkir = parseInt($("#ongkir").val());
  }
  hitungTotal();
});

$("#btnTambah").click(() => {
  if (switch2 === false) {
    alert("Tolong dipilih Customernya!");
  } else {
    $("#myModal").modal("show");
  }
});

function tambahItem(kode, btn) {
  switch3 = true;
  $.get(
    link,
    {
      request: "hasil_packing",
      kode_customer: $("#kode_customer").val(),
      nomor_packing: kode
    },
    res => {
      res = JSON.parse(res);
      res.forEach(data => {
        $("#tableku").append(`
            <tr>
                <td>${data.nomor_packing}</td>
                <td>${data.barcode}</td>
                <td>${data.nama_item}</td>
                <td>${data.quantity_packing}</td>
                <td>${data.harga_satuan}</td>
                <td>${data.totalHarga}</td>
            </tr>
        `);
        subtotal += parseInt(data.totalHarga);
      });
    }
  ).then(() => {
    packing.push(kode);
    $("#dataJs").val(JSON.stringify(packing));
    $("#subtotal").val(subtotal);
    hitungTotal();
    $("#" + btn).attr("disabled", true);
    $("#modal").modal("hide");
  });
}

function ajax(kode) {
  $.get(
    link,
    {
      request: "cari_customer",
      data: kode
    },
    res => {
      res = JSON.parse(res);
      $("#kode_customer").val(res.kode);
      $("#nama_customer").val(res.nama);
      $("#nama_customer2").val(res.nama);
      $("#cabang_customer").val(res.kota);
      $("#alamat1_customer").val(res.alamat);
      $("#alamat2_customer").val(res.alamat);
      $("#telepon_customer").val(res.telepon);
    }
  );
}
