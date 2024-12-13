function reset_form() {
  $("#nik").val("").focus();
  $("#nama").val("");
  $("#ttl").val("");
  $("#gender").val("");
  $("#goldarah").val("");
  $("#alamat").val("");
  $("#notelp").val("");
}

function load_data() {
  $.post(
    "pasien/load_data",
    {},
    function (data) {
      console.log(data);
      $("#table2").DataTable().clear().destroy();
      $("#table2 > tbody").html("");
      $.each(data.pasien, function (idx, val) {
        html = "<tr>";
        html += "<td>" + (idx + 1) + "</td>";
        html += "<td>" + val["namaPasien"] + "</td>";
        html += "<td>" + val["genderPasien"] + "</td>";
        html += "<td>" + val["golDarahPasien"] + "</td>";
        html +=
          '<td><button class="btn btn-warning btn-sm btn-edit"  onclick="edit_data(' +
          val["idPasien"] +
          ')">Detail</button></td>';
        html +=
          '<td><button class="btn btn-danger btn-sm " onclick="hapus_data(' +
          val["idPasien"] +
          ')">Hapus</button></td>';
        html += "</tr>";
        $("#table2 > tbody").append(html);
      });

      $("#table2").DataTable({
        responsive: true,
        processing: true,
        pagingType: "first_last_numbers",
        order: [[0, 'asc']],
        dom:
          "<'row'<'col-3'l><'col-9'f>>" +
          "<'row dt-row'<'col-sm-12'tr>>" +
          "<'row'<'col-4'i><'col-8'p>>",
        language: {
          info: "Page _PAGE_ of _PAGES_",
          lengthMenu: "_MENU_",
          search: "",
          searchPlaceholder: "Search..",
        },
      });
    },
    "json"
  );
}

function simpan_data() {
  let nik = $("#nik").val();
  let nama = $("#nama").val();
  let ttl = $("#ttl").val();
  let gender = $("#gender").val();
  let goldarah = $("#goldarah").val();
  let alamat = $("#alamat").val();
  let notelp = $("#notelp").val();


  if (nik === "" || nama === "" || ttl === "" || gender === "" || goldarah === "" || alamat === "" || notelp === "") {
    Swal.fire({
      title: "Error!",
      text: "Ada Form yang belum dimasukkan!!!",
      icon: "error",
      confirmButtonText: "OK",
    });
  } else {
    let formData = new FormData();
    formData.append('nik', nik);
    formData.append('nama', nama);
    formData.append('ttl', ttl);
    formData.append('gender', gender);
    formData.append('goldarah', goldarah);
    formData.append('alamat', alamat);
    formData.append('notelp', notelp)

    $.ajax({
      url: 'pasien/create',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (data) {
        if (data.status === "error") {
          Swal.fire({
            title: "Error!",
            text: data.msg,
            icon: "error",
            confirmButtonText: "OK",
          });
        } else {
          Swal.fire({
            title: "Success!",
            text: data.msg,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            $("#addModal").modal("hide");
            load_data();
          });
        }
      }
    });
  }
}

function edit_data(id) {
  $.post(
    "pasien/edit_table",
    { id: id },
    function (data) {
      $("#nik").val(data.data.nikPasien);
      $("#nama").val(data.data.namaPasien);
      $("#ttl").val(data.data.ttlPasien);
      $("#gender").val(data.data.genderPasien);
      $("#goldarah").val(data.data.golDarahPasien);
      $("#alamat").val(data.data.alamatPasien);
      $("#notelp").val(data.data.noTelpPasien);

      $("#addModal").data("id", id);
      $("#addModal").modal("show");
      $(".btn-submit").hide();
      $(".btn-editen").hide();
    },
    "json"
  );
}

function hapus_data(id) {
  Swal.fire({
    title: "Apakah kamu ingin menghapus data?",
    showDenyButton: true,
    showCancelButton: true,
    denyButtonText: "No",
    confirmButtonText: "Yes",
    customClass: {
      actions: "my-actions",
      cancelButton: "order-1 right-gap",
      confirmButton: "order-2",
      denyButton: "order-3",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "pasien/delete_table",
        { id: id },
        function (data) {
          if (data.status === "success") {
            Swal.fire({
              title: "Succes!",
              text: data.msg,
              icon: "success",
              confirmButtonText: "OK",
            }).then(() => {
              load_data();
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: data.msg,
              icon: "error",
              confirmButtonText: "OK",
            });
          }
        },
        "json"
      );
    } else if (result.isDenied) {
      Swal.fire("Perubahan tidak tersimpan", "", "info");
    }
  });
}

$(document).ready(function () {

  $("body").on("keyup", ".angka", function (e) {
    if (this.value != this.value.replace(/[^0-9\.]/g, "")) {
      this.value = this.value.replace(/[^0-9\.]/g, "");
    }
  });

  $(".btn-closed").click(function () {
    reset_form();
  });

  $(".btn-add").click(function () {
    reset_form();
    $(".btn-submit").show();
    $(".btn-editen").hide();
  });
  $(".btn-add").click(function () {
    $(".btn-submit").show();
    $(".btn-editen").hide();
  });-
  load_data();
});