<div class="page-header">
    <h1>Periode Penilaian Karyawan</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="karyawan" />
        <div class="form-group">
            <a class="btn btn-primary" href="?m=periode_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
        </div>
    </form>
</div>
<div class="table-responsive">
    <?php
    $rows_periode = $db->get_results("SELECT * FROM tb_periode 
        ORDER BY periode_id");
    ?>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>       
                <th>Periode</th>
                <th>Tanggal Periode</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        
        $no=1;
        if(is_array($rows_periode)){
            foreach($rows_periode as $row){
                ?>
                <tr>
                    <td><?= $no;?></td>
                    <td><?= $row->nama_periode;?></td>
                    <td><?= $row->tgl_periode;?></td>
                    <td><?= $row->keterangan;?></td>
                    <td>
                         <!-- <a class="btn btn-xs btn-danger" href="?m=hitung&p_id=<?php echo $row->periode_id?> "><span class="glyphicon glyphicon-edit"></span> Hitung</a> -->
                        <?php
                        if($row->status == 1){
                            ?>
                            <a class="btn btn-xs btn-primary disabled" disabled href="?m=nilai_karyawan&p_id=<?php echo $row->periode_id?> "><span class="glyphicon glyphicon-list-alt"></span> Mulai</a>
                            <?php
                        }else {
                            ?>
                            <a class="btn btn-xs btn-primary" href="?m=nilai_karyawan&p_id=<?php echo $row->periode_id?> "><span class="glyphicon glyphicon-list-alt"></span> Mulai</a>
                            <?php
                        }
                        ?>
                        <!-- <a class="btn btn-xs btn-info" href="?m=periode_lihat&p_id=<?php echo $row->periode_id?> "><span class="glyphicon glyphicon-eye-open"></span> Lihat</a> -->
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=periode_hapus&ID=<?=$row->periode_id?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
    </table>
    <?php include "includes/footer.php"; ?>
</div>
</div>