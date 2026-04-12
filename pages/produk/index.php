<div class="row mb-4">
    <div class="col-lg-6">
        <h1>Data Produk</h1>
        <p>Kelola produk master dan variasi SKU toko batik.</p>
        <button class="btn btn-primary" id="tambah">+ Tambah Produk</button>

    </div>
</div>


<div class="row" id="tabel">

</div>
<script>
    function loadTable() {
        $('#tabel').load('pages/produk/tabel.php');
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').click(function () {
            $('.modal').modal('show');
            $('.modal-title').text('Tambah Produk');
            $('.modal-body').load('pages/produk/form.php');
        });
    });
</script>