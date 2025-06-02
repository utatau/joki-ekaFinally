function validateForm() {
    var id_user = document.forms["myForm"]["iduser"].value;
    var user = document.forms["myForm"]["user"].value;
    var pwd = document.forms["myForm"]["pwd"].value;
    var kpwd = document.forms["myForm"]["kpwd"].value;
    if (user == '') {
        validasi('Username wajib di isi!', 'warning');
        return false;
    } else if (id_user == '') {
        validasi('Panjang Password minimal 6 karakter!', 'warning');
        return false;
    }
    else if (pwd !== '' || kpwd !== '') {
        if (pwd.length < 6) {
            validasi('Panjang Password minimal 6 karakter!', 'warning');
            return false;
        } else if (pwd !== kpwd) {
            validasi('Konfirmasi Password tidak sesuai!', 'warning');
            return false;
        }

    }

}


function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}
