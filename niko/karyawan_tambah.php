<div class="page-header">
    <h1>Tambah Data Karyawan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_karyawan" value="<?=set_value('kode_karyawan', kode_oto('kode_karyawan', 'tb_karyawan', 'K', 2))?>"/>
            </div>
            <!-- <div class="form-group">
                <label>NIK <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nik" value="<?=set_value('nik')?>"/>
            </div> -->

            <div class="form-group">
                <label>Nama Pemasok <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_karyawan" value="<?=set_value('nama_karyawan')?>"/>
            </div>
            <div class="form-group">
                <label>Alamat <span class="text-danger"></span></label>
                <textarea class="form-control" name="departemen"><?=set_value('departemen')?></textarea>
                <!-- <input class="form-control" type="text" name="departemen" value="<?=set_value('departemen')?>"/> -->
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-info" href="?m=karyawan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>

            <?php include "includes/footer.php"; ?>
            
        </form>
    </div>
</div>