<div class="page-header">
    <h1>Data Kriteria</h1>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_kriteria WHERE nama_kriteria LIKE '%$q%' ORDER BY kode_kriteria");
        $no=1;
        foreach($rows as $row):?>

        <?php
        $bold = '';
        if($row->parent == '0'){
            $bold = 'font-weight:bold';
        }
        ?>
        <tr style="<?= $bold;?>">
            <td><?=$row->kode_kriteria?></td>
            <td><?=$row->nama_kriteria?></td>
            <td><?=$row->bobot?></td>
        </tr>
        <?php
        $no++; 
        endforeach;?>
        </table>
        <?php include "includes/footer.php"; ?>
    </div>
</div>