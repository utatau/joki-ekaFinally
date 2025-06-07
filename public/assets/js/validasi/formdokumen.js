
function validateFormUpdate() {
    var kode_rak = document.forms["myFormUpdate"]["kode_rak"].value;
    var nama_tenaga_krj = document.forms["myFormUpdate"]["nama_tenaga_krj"].value;
    var kpj = document.forms["myFormUpdate"]["kpj"].value;
    var kategori = document.forms["myFormUpdate"]["kategori"].value;
    var tgl_upload = document.forms["myFormUpdate"]["tgl_upload"].value;

    if (kode_rak == '') {
        validasi('Kode Rak wajib di isi!', 'warning');
        return false;
    } else if (nama_tenaga_krj == '') {
        validasi('Nama Tenaga Kerja wajib di isi!', 'warning');
        return false;
    } else if (kpj == '') {
        validasi('kpj wajib di isi!', 'warning');
        return false;
    } else if (kategori == '') {
        validasi('Kategori wajib di isi!', 'warning');
        return false;
    } else if (tgl_upload == '') {
        validasi('Tanggal Upload wajib di isi!', 'warning');
        return false;
    }

}
function validasiFormTambah() {
    var kode_rak = document.forms["myFormTambah"]["kode_rak"].value;
    var nama_tenaga_krj = document.forms["myFormTambah"]["nama_tenaga_krj"].value;
    var kpj = document.forms["myFormTambah"]["kpj"].value;
    var kategori = document.forms["myFormTambah"]["kategori"].value;
    var tgl_upload = document.forms["myFormTambah"]["tgl_upload"].value;

    if (kode_rak == '') {
        validasi('Kode Rak wajib di isi!', 'warning');
        return false;
    } else if (nama_tenaga_krj == '') {
        validasi('Nama Tenaga Kerja wajib di isi!', 'warning');
        return false;
    } else if (kpj == '') {
        validasi('kpj wajib di isi!', 'warning');
        return false;
    } else if (kategori == '') {
        validasi('Kategori wajib di isi!', 'warning');
        return false;
    } else if (tgl_upload == '') {
        validasi('Tanggal Upload wajib di isi!', 'warning');
        return false;
    }

}


function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}


function fileIsValid(fileName) {
    var ext = fileName.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    var isValid = true;
    switch (ext) {
        case 'pdf':
        case 'xlsx':
        case 'PDF':
        case 'XLSX':
            break;
        default:
            this.value = '';
            isValid = false;
    }
    return isValid;
}

function VerifyFileNameAndFileSize() {
    var file = document.getElementById('fileBaru').files[0];
    if (file != null) {
        var fileName = file.name;
        if (fileIsValid(fileName) == false) {
            validasi('Format bukan PDF/EXCEL!', 'warning');
            document.getElementById('fileBaru').value = null;
            return false;
        }
        var content;
        var size = file.size;
        if ((size != null) && ((size / (1024 * 1024)) > 3)) {
            validasi('Ukuran maximum 5MB', 'warning');
            document.getElementById('fileBaru').value = null;
            return false;
        }

        var ext = fileName.match(/\.([^\.]+)$/)[1];
        ext = ext.toLowerCase();
        $(".custom-file-label").addClass("selected").html(file.name);
        document.getElementById('outputFile').src = window.URL.createObjectURL(file);
        return true;

    } else
        return false;
}