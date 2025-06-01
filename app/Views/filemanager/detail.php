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
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-sm-flex">
            <a href="<?= base_url('filemanager') ?>" class="btn btn-md btn-circle btn-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
            &nbsp;
            <h1 class="h2 mb-0 text-gray-800 mb-3">Detail Dokumen</h1>
        </div>
    </div>

    <?php if ($dokumen): ?>
        <div class="d-sm-flex justify-content-between mb-0">
            <div class="col-lg-12 mb-4">
                <div class="card shadow border-bottom-secondary mb-4">
                    <div class="card-body d-sm-flex">
                        <div class="col-lg-12">
                           <iframe width="100%" height="800px"
                                src="<?= base_url('assets/upload/dokumen/' . $dokumen->file) ?>" 
                                frameborder="0" allowfullscreen>
                            </iframe>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Dokumen tidak ditemukan.</div>
    <?php endif; ?>
</div>
</div>


<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>

<?php if (session()->getFlashdata('Pesan')): ?>

<?php else: ?>
    <script>
        $(document).ready(function() {

            $('#pdf').hide();

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