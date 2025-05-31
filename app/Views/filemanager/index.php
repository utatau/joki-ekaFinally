<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 1 = tanggal
	// variabel pecahkan 0 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<div class="container-fluid">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span class="text-white-50 p-3">
            <input type="date" name="cekout" class="form-control shadow-none">
        </span>
    </div> -->
    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <div class="input-group">
                                <input name="tglawal" id="datepicker1" autocomplete="off" placeholder="tanggal mulai"
                                    class="form-control border-1 small" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="date1" onclick="filter()">
                                        <i class="fas fa-calendar fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    <div class="col-lg-12 mb-4" id="container">
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dtHorizontalExample" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kode Rak</th>
                                <th>Nama Tenaga Kerja</th>
                                <th>KPJ</th>
                                <th>Kategori</th>
                                <th>Tanggal Upload</th>
                                <th>Masa Berlaku</th>
                                <th>File</th>
                                <?php if (session()->get('login_session')['level'] == 'admin' || session()->get('login_session')['level'] == 'staff'): ?>
                                    <th width="1%">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody style="cursor:pointer;" id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/filemanager.js"></script>
<script src="<?= base_url(); ?>assets/js/filter/filemanager.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

    $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
</script>


<?php if (session()->getFlashdata('Pesan')): ?>
    <?= session()->getFlashdata('Pesan') ?>
<?php else: ?>
    <script>
        $(document).ready(function() {
            let timerInterval
            Swal.fire({
                title: 'Memuat...',
                timer: 1000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {

            })
        });
    </script>
<?php endif; ?>
