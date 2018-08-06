<div class="page-header">
    <h1>Data Karyawan</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="karyawan" />
            <div class="form-group">
                <a class="btn btn-primary" href="?m=karyawan_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah </a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>        
                <th>Kode</th>
                <th>Nama Pemasok</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_karyawan WHERE kode_karyawan LIKE '%$q%' OR nama_karyawan LIKE '%$q%' ORDER BY kode_karyawan");
        $no=1;
        foreach($rows as $row):?>
        <tr>
            <td><?= $no;?></td>
            <td><?=$row->kode_karyawan?></td>
            <td><?=$row->nama_karyawan?></td>
            <td><?=$row->departemen?></td>
            <td>
                <a class="btn btn-xs btn-info" href="?m=karyawan_ubah&ID=<?=$row->kode_karyawan?>"><span class="glyphicon glyphicon-edit"></span> Ubah </a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=karyawan_hapus&ID=<?=$row->kode_karyawan?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>
            </td>
        </tr>
        <?php
        $no++; 
        endforeach;?>
        </table>
        <?php include "includes/footer.php"; ?>
    </div>
</div>