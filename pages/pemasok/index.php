<div class="row mb-2">
    <div class="col-sm-4">
        <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                class="mdi mdi-plus"></i> Tambah Pemasok</button>
    </div>
</div>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Pemasok</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('pages/pemasok/tabel-pemasok.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Pemasok Baru');
            $('.modal-body').load('pages/pemasok/tambah-pemasok.php');
        });
    });
</script>