<?php
    $row = $db->get_row("SELECT * FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_kriteria" readonly="readonly" value="<?=$row->kode_kriteria?>"/>
            </div>
            <div class="form-group">
                <label>Nama kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_kriteria" value="<?=set_value('nama_kriteria', $row->nama_kriteria)?>"/>
            </div>
            <div class="form-group">
                        <label for="exampleFormControlInput1">Atribut</label>
                        <select class="form-control" id="attribut" name="attribut">
                        <option value='benefit'>Benefit</option>
                        <option value='cost'>Cost</option>
                        </select>
            </div>
            <div class="form-group">
                <label>Bobot <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="bobot" value="<?=set_value('bobot', $row->bobot)?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-info" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>

            <?php include "includes/footer.php"; ?>
            
        </form>
    </div>
</div>