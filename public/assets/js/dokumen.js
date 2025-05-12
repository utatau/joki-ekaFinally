$(document).ready(function () {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');

});

function ambilData(id) {
    var link = $('#baseurl').val();
    var base_url = link + 'dokumen/getData';
    $.ajax({
        type: 'POST',
        data: { id: id },
        url: base_url,
        dataType: 'json',
        success: function (hasil) {
            $('#id_dokumen_ubah').val(hasil[0].id_dokumen);
            $('#kode_rak_ubah').val(hasil[0].kode_rak);
            $('#nama_tenaga_krj_ubah').val(hasil[0].nama_tenaga_krj);
            $('#kpj_ubah').val(hasil[0].kpj);
            $('#kategori_ubah').val(hasil[0].id_kategori).trigger('chosen:updated');
            $('#tgl_upload_ubah').val(hasil[0].tgl_upload);
            $('#masa_berlaku_ubah').val(hasil[0].masa_berlaku);
            $('#masa_berlaku_lama_ubah').val(hasil[0].masa_berlaku);
            $('#fileLamaNama_ubah').val(hasil[0].file);
            $('#fileLama_ubah').val('');
            $('#ubah').modal('show');
        }
    });
}


function konfirmasi(id) {
    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Hapus Data ini?",
        icon: "warning",
        closeOnClickOutside: false,
        showCancelButton: true,
        confirmButtonText: 'Iya',
        confirmButtonColor: '#4e73df',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: "Memuat...",
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                timer: 1000,
                showConfirmButton: false,
            }).then(
                function () {
                    window.location.href = base_url + "dokumen/proses_hapus/" + id;
                }
            );
        }
    });


}