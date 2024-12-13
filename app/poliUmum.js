function reset_form() {
    $("#nik").val("").focus();
    $("#pasien").val("");
    $("#poli").val("");
}

function load_data() {
    $.post(
        "poliUmum/load_data",
        {},
        function (data) {
            console.log(data);
            $("#table2").DataTable().clear().destroy();
            $("#table2 > tbody").html("");
            $.each(data.poliumum, function (idx, val) {
                html = "<tr>";
                html += "<td>" + (idx + 1) + "</td>";
                html += "<td>" + val["namaPoli"] + "</td>";
                html += "<td>" + val["namaPasien"] + "</td>";
                html += "<td>" + val["antrianNo"] + "</td>";
                html += "<td>" + val["antrianWaktuReg"] + "</td>";
                html += '<td><span onclick="status_data(' + val["idAntrian"] + ',' + val["antrianStatus"] + ')" class="badge ' +
                    (val["antrianStatus"] == "1" ? "bg-success" :
                        (val["antrianStatus"] == "2" ? "bg-primary" : "bg-secondary")) + '">' +
                    (val["antrianStatus"] == "1" ? "<i class='bi bi-clock'></i> Dilayani" :
                        (val["antrianStatus"] == "2" ? "<i class='bi bi-check-circle'></i> Selesai" : "<i class='bi bi-hourglass-split'></i> Menunggu")) +
                    "</span></td>";
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

function load_poli() {
    $.post('poliUmum/load_poli', function (res) {
        $("#poli").empty()

        $("#poli").append('<option value = "" disabled selected>Pilih Nama</option>')


        $.each(res.poli, function (i, v) {
            $("#poli").append('<option value = "' + v.idPoli + '">' + v.namaPoli + '</option>')
        }
        )
    }, 'json');
}

function load_pasien() {
    $.post('poliUmum/load_pasien', function (res) {
        $("#pasien").empty()

        $("#pasien").append('<option value = "" disabled selected>Pilih Nama</option>')


        $.each(res.pasien, function (i, v) {
            $("#pasien").append('<option value = "' + v.idPasien + '">' + v.namaPasien + '</option>')
        }
        )
    }, 'json');
}

// let nikChoices;
// let namaChoices;
// let pasienData = []; 

// function load_pasien() {
//     $.post("poliUmum/load_pasien", function (res) {
//         if (res && res.pasien && Array.isArray(res.pasien)) {
//             pasienData = res.pasien; 

//             const $nik = $("#nik");
//             $nik.empty(); 

//             // Tambahkan opsi default
//             $nik.append('<option value="">Pilih NIK</option>');

//             // Tambahkan opsi dari data pasien
//             $.each(res.pasien, function (i, v) {
//                 $nik.append(
//                     '<option value="' + v.idPasien + '">' + v.nikPasien + "</option>"
//                 );
//             });

//             if (nikChoices) {
//                 nikChoices.destroy();
//             }
//             nikChoices = new Choices($nik[0]);

//             nama();
//         } else {
//             console.error("Respon server tidak valid:", res);
//         }
//     }, "json");
// }

// function nama() {
//     const $pasien = $("#pasien");
//     $('#nik').on('change', function () {
//         const selectedPasienId = $(this).val();
//         const matchedPasien = pasienData.find(pasien => pasien.idPasien === selectedPasienId);
//         $pasien.empty(); // Kosongkan dropdown nama
//         if (matchedPasien) {
//             $pasien.append('<option value="' + matchedPasien.idPasien + '">' + matchedPasien.namaPasien + '</option>');
//         } else {
//             $pasien.append('<option value="" disabled selected>Nama Pasien</option>');
//         }

//         // Re-initialize Choices.js jika digunakan
//         if (namaChoices) {
//             namaChoices.destroy();
//         }
//         namaChoices = new Choices($pasien[0]);
//     });
// }

function simpan_data() {
    let pasien = $("#pasien").val();
    let poli = $("#poli").val();

    console.log('Pasien:', pasien, 'Poli:', poli);


    if (pasien === "" || poli === "") {
        Swal.fire({
            title: "Error!",
            text: "Ada Form yang belum dimasukkan!!!",
            icon: "error",
            confirmButtonText: "OK",
        });
    } else {
        let formData = new FormData();
        formData.append('pasien', pasien);
        formData.append('poli', poli);

        $.ajax({
            url: 'poliUmum/create',
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
                        load_data();
                        $("#addModal").modal("hide");
                        window.location.reload();
                    });
                }
            }
        });
    }
}

function status_data(id, status) {
    let actionText = "";
    let confirmButtonText = "";

    // Menentukan teks aksi dan tombol konfirmasi berdasarkan status
    if (status == 1) {
        actionText = "Selesaikan antrian?";
        confirmButtonText = "Ya, Selesaikan";
    } else if (status == 0) {
        actionText = "Pasien sedang dilayani?";
        confirmButtonText = "Ya, Dilayani";
    } else if (status == 2) {
        return;
    }

    // Konfirmasi dengan SweetAlert
    Swal.fire({
        title: "Konfirmasi",
        text: `${actionText }`,
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Batal",
        confirmButtonText: confirmButtonText,
    }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    "poliUmum/status_data",
                    { id: id, status: status }, // Kirimkan status dalam request
                    function (data) {
                        if (data.status === "success") {
                            Swal.fire({
                                title: "Sukses!",
                                text: data.msg,
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then(() => {
                                load_data(); // Memuat data setelah update
                                load_pasien();
                                load_poli();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: data.msg,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    "json"
                );
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
    });

    load_data();
    load_poli();
    load_pasien();
});