<div class="page-header">
    <h1>Input Nilai Karyawan</h1>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php if($_POST) include'aksi.php'?>
        <?php
        $p_id = esc_field($_GET['p_id']);
        $periode_name = $db->get_row("SELECT tgl_periode, nama_periode FROM tb_periode WHERE periode_id='$p_id' ");

        ?>
        <form method="post">
            <input type="hidden" name="periode_id" value="<?= $p_id;?>">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nama Periode</label>
                        <input class="form-control" type="text" readonly="" value="<?= $periode_name->nama_periode;?>" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Periode</label>
                        <input class="form-control" type="text" readonly="" value="<?= $periode_name->tgl_periode;?>" />
                    </div>        
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nama Pemasok <span class="text-danger">*</span></label>
                        <?php

                        $rows = $db->get_results("SELECT a.kode_karyawan,a.nama_karyawan FROM tb_karyawan a WHERE a.kode_karyawan NOT IN (SELECT b.kode_karyawan FROM tb_nilai_karyawan b  WHERE periode_id ='$p_id' )");
                        
                        ?>
                        <select class="form-control" name="kode_karyawan" required="">
                            <option value="">Pilih Nama Pemasok</option>
                            <?php
                            foreach($rows as $row){
                                ?>
                                <option value="<?= $row->kode_karyawan;?>"><?= $row->nama_karyawan;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <?php
                $kriteria_cat = $db->get_results("SELECT kode_kriteria,nama_kriteria FROM tb_kriteria WHERE parent = '0' ORDER BY kode_kriteria");
                $rows_kriteria = $db->get_results("SELECT kode_kriteria,nama_kriteria FROM tb_kriteria WHERE parent != '0' ORDER BY kode_kriteria");
                $no_cat = 1;
                $no = 1;
                foreach ($kriteria_cat as $key) {
                    $kriteria = $db->get_results("SELECT kode_kriteria,nama_kriteria FROM tb_kriteria WHERE parent = '$key->kode_kriteria' ORDER BY kode_kriteria");
                    ?>
                    <div class="col-sm-6">
                        <!-- <h4></h4> -->
                        <div class="panel panel-default">
                            <div class="panel-heading"><?= $key->nama_kriteria;?></div>
                            <div class="panel-body">
                                <?php
                                
                                foreach($kriteria as $row_k){
                                    ?>
                                    <div class="form-group">
                                        <label><?= $row_k->nama_kriteria;?> <span class="text-danger"></span></label>
                                        <input class="form-control" type="number" min="0" max="100" name="nilai_<?= $no;?>" placeholder="Nilai" required="" />
                                        <input type="hidden" name="kriteria_<?= $no;?>" value="<?= $row_k->kode_kriteria;?>">
                                    </div>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($no_cat % 2 == 0){
                        echo '</div><div class="row">';
                    }
                    $no_cat++;
                }
                ?>
            </div>
            
            <input type="hidden" name="count_kriteria" value="<?= count($rows_kriteria);?>" />
            <div class="form-group">
                <button class="btn btn-info" type="submit" name="submit"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-info" href="?m=nilai_karyawan&p_id=<?= $p_id;?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>

            <?php include "includes/footer.php"; ?>

        </form>
    </div>
</div>