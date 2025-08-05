$(document).ready(function () {
    const tglawal = $("[name='tglawal']").val();
    const tglakhir = "9999-12-31";

    if (tglawal !== '') {
        filterBm(tglawal, tglakhir);
    } else {
        ambilBm();
    }

    $.fn.dataTable.ext.errMode = 'none';
    $('#dtHorizontalExample').on('error.dt', function (e, settings, techNote, message) {
        console.log('error', message);
    });
});

function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}

function refresh() {
    var t = $('#dtHorizontalExample').DataTable();
    t.ajax.reload();
}

function reset() {
    $("[name='tglawal']").val("");
    $("[name='tglakhir']").val("9999-12-31");
    ambilBm();
}

function ambilBm() {
    var link = $('#baseurl').val();
    var base_url = link + 'Filemanager/getFilemanager';

    var t = $('#dtHorizontalExample').DataTable({
        "processing": true,
        "info": false,
        "searching": true,
        "order": [[0, "desc"]],
        lengthChange: false,
        "ajax": {
            "url": base_url,
            "dataSrc": ""
        },
        columns: [
            { "data": "kode_rak" },
            { "data": "nama_tenaga_krj" },
            { "data": "kpj" },
            { "data": "sub_kategori" },
            { "data": "tgl_upload" },
            {
                "data": "masa_berlaku",
                "render": function (data, type, row) {
                    return data && data.startsWith("9999-12-31") ? "Seumur Hidup" : data;
                }
            },
            { "data": "file" },
            {
                "data": "id_dokumen",
                "render": function (data, type, row) {
                    return `
                    <center>
                        <a href="#" onclick="detail('${data}')" class="btn btn-circle btn-success btn-sm">
                            <i class="fas fa-info"></i>
                        </a>
                    </center>`;
                }
            }
        ],
        "destroy": true
    });

    t.on('error.dt', function (e, settings, techNote, message) {
        console.log('DataTables Ajax error:', message);
        e.preventDefault();
    });

    t.on('order.dt search.dt', function () {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $('.dataTables_length').addClass('bs-select');
}

function filterBm(tglawal, tglakhir) {
    var link = $('#baseurl').val();
    var base_url = link + 'Filemanager/filterFilemanager/' + tglawal + '/' + tglakhir;

    var t = $('#dtHorizontalExample').DataTable({
        "processing": true,
        "info": false,
        "order": [[0, "desc"]],
        lengthChange: false,
        "ajax": {
            "url": base_url,
            "dataSrc": ""
        },
        columns: [
            { data: null },
            { "data": "kode_rak" },
            { "data": "nama_tenaga_krj" },
            { "data": "kpj" },
            { "data": "sub_kategori" },
            { "data": "tgl_upload" },
            {
                "data": "masa_berlaku",
                "render": function (data, type, row) {

                    return data && data.startsWith("9999-12-31") ? "Seumur Hidup" : data;
                }
            },
            { "data": "file" },
            {
                "data": "id_dokumen",
                "render": function (data, type, row) {
                    return `
                    <center>
                        <a href="#" onclick="detail('${data}')" class="btn btn-circle btn-success btn-sm">
                            <i class="fas fa-info"></i>
                        </a>
                    </center>`;
                }
            }
        ],
        "destroy": true
    });

    t.on('error.dt', function (e, settings, techNote, message) {
        console.log('DataTables Ajax error:', message);
        e.preventDefault();
    });

    t.on('order.dt search.dt', function () {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $('.dataTables_length').addClass('bs-select');
}

function detail(id) {
    const base_url = $('#baseurl').val();
    window.location.href = base_url + 'filemanager/detail/' + id;
}
