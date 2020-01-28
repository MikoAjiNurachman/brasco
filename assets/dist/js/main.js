var arrActive = [
  "header_profil",
  "header_jurnal",
  "header_customer",
  "laporan_stock_opname",
  "header_counter",
  [
    "header_inventory",
    "header_inventory_master",
    "header_inventory_search",
    "header_inventory_edit",
    "header_satuan_master",
    "header_type_barang"
  ],
  ["header_stock", "header_stock_input", "header_stock_selisih"],
  [
    "header_perubahan",
    "header_perubahan_pengajuan",
    "header_perubahan_approval",
    "header_perubahan_status"
  ],
  [
    "header_supplier",
    "header_supplier_tambah_saldo",
    "header_supplier_master",
    "header_supplier_list",
    "header_supplier_hutang",
    "header_supplier_saldo",
    "header_supplier_tempo"
  ],
  [
    "header_po",
    "header_purchase_order",
    "header_purchase_cetak",
    "header_purchase_data",
    "header_purchase_approval",
    "header_purchase_status",
    "header_purchase_closed"
  ],
  [
    "header_purchasing",
    "header_purchasing_input",
    "header_purchasing_masuk",
    "header_purchasing_list"
  ],
  [
    "header_sales",
    "header_sales_input",
    "header_sales_laporan",
    "header_sales_detail",
    "header_sales_edit"
  ],
  ["header_order", "header_order_input", "header_order_list"],
  ["header_picking", "header_picking_list", "header_picking_gudang"],
  ["header_packing", "header_packing_gudang", "header_packing_list"],
  "header_invoice",
  "header_surat_jalan",
  "header_kwitansi",
  "header_retur",
  ["header_diskon", "header_diskon_buat", "header_diskon_approval"],
  [
    "header_bank",
    "header_bank_pembayaran",
    "header_bank_penerimaan",
    "header_bank_pelunasan_customer",
    "header_bank_pelunasan_supplier",
    "header_bank_uang_muka_ke_supplier",
    "header_bank_uang_muka_dari_customer",
    "header_bank_master",
    "header_bank_transfer"
  ]
];
$(document).ready(function() {
  for (var i in arrActive) {
    if (arrActive[i].constructor == Array) {
      if (active == arrActive[i][0]) {
        $("#" + arrActive[i][0]).addClass("active");
        for (var p in arrActive[i]) {
          if (active_2 == arrActive[i][p]) {
            $("#" + arrActive[i][p]).addClass("active");
          }
        }
      }
    } else {
      if (active == arrActive[i]) {
        $("#" + arrActive[i]).addClass("active");
      }
    }
  }
  $("#table_pu").dataTable();
});

//barcode quantity harga_jual keterangan

$("#cetak_barcode_input").on("click", function() {
  $("#table").append(
    '<tr id="tr_po_' +
      i +
      '">' +
      "<td>" +
      i +
      "</td>" +
      "<td>" +
      $("#barcode").val() +
      "</td>" +
      "<td>" +
      $("#quantity").val() +
      "</td>" +
      "<td>" +
      $("#harga_jual").val() +
      "</td>" +
      "<td>" +
      $("#keterangan").val() +
      "</td>" +
      "<td>" +
      '<button type="button" onclick="po_hapus(' +
      i +
      ')" class="btn btn-danger"> Hapus</button>' +
      "</td>" +
      "</tr>"
  );
  i++;
});

function fix_iteration(nama_table) {
  var num = 1;
  $(nama_table)
    .find("tr")
    .each(function() {
      $(this)
        .find("#icr")
        .each(function() {
          $(this).html(num++);
        });
    });
  num = 1;
}
