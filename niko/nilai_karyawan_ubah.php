<div class="page-header">
    <h1>Ubah Nilai Karyawan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <?php 
            $get_id = $_GET['id'];
            $data_edit = $db->get_results("SELECT a.id,a.kode_karyawan,b.nama_karyawan,a.kode_kriteria,a.nilai FROM tb_nilai_karyawan a
                 JOIN tb_karyawan b ON a.kode_karyawan=b.kode_karyawan
                WHERE a.kode_karyawan='$get_id' 
                ");
            $p_id = esc_field($_GET['p_id']);
            $periode_name = $db->get_row("SELECT tgl_periode, nama_periode FROM tb_periode WHERE periode_id='$p_id' ");
            ?>
        <form method="post">
            <input type="hidden" name="periode_id" value="<?= $p_id;?>">
            <div class="form-group">
                <label>Nama Periode</label>
                <input class="form-control" type="text" readonly="" value="<?= $periode_name->nama_periode;?>" />
            </div>
            <div class="form-group">
                <label>Tanggal Periode</label>
                <input class="form-control" type="text" readonly="" value="<?= $periode_name->tgl_periode;?>" />
            </div>
            <div class="form-group">
                <label>Nama Karyawan <span class="text-danger">*</span></label>
                
                <input class="form-control" type="text" name="nama_karyawan" readonly="readonly" value="<?=$data_edit[0]->nama_karyawan?>" />
                <input class="form-control" type="hidden" name="kode_karyawan" readonly="readonly" value="<?=$data_edit[0]->kode_karyawan?>" />
            </div>
            <?php
            $rows_kriteria = $db->get_results("SELECT kode_kriteria,nama_kriteria FROM tb_kriteria ORDER BY kode_kriteria");
            $no = 1;
            foreach($rows_kriteria as $row_k){
                $nilai_data = 0;
                foreach ($data_edit as $row_data) {
                     if($row_k->kode_kriteria == $row_data->kode_kriteria ){
                        $nilai_data = $row_data->nilai;

                        ?>
                        <input class="form-control" type="hidden" name="id_<?= $no;?>" readonly="readonly" value="<?=$row_data->id?>" />
                        <?php
                    }
                }
               
                ?>
                <div class="form-group">
                    <label><?= $row_k->nama_kriteria;?> <span class="text-danger"></span></label>
                    <input class="form-control" type="number" min="0" max="100" name="nilai_<?= $no;?>" value="<?= $nilai_data;?>" placeholder="Nilai" required="" />
                    <input type="hidden" name="kriteria_<?= $no;?>" value="<?= $row_k->kode_kriteria;?>">
                </div>
                <?php
                $no++;
            }
            ?>
           <input type="hidden" name="count_kriteria" value="<?= count($rows_kriteria);?>" />
            <div class="form-group">
                <button class="btn btn-info" type="submit" name="submit"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-info" href="?m=nilai_karyawan&p_id=<?= $p_id;?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>

            <?php include "includes/footer.php"; ?>

        </form>
    </div>
</div>