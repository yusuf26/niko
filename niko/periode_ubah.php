<?php
    $row = $db->get_row("SELECT * FROM tb_periode WHERE periode_id='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Priode</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_periode" readonly="readonly" value="<?=$row->nama_periode?>"/>
            <div class="form-group">
                <label>Tanggal Periode <span class="text-danger"></span></label>
                <input class="form-control" type="text" id="tgl_periode" name="tgl_periode" value="<?= date('Y-m-d',strtotime('-6 months')).' - '.date('Y-m-d');?>" />
            </div>
            <div class="form-group">
                <label>Keterangan<span class="text-danger"></span></label>
                <textarea class="form-control" name="keterangan"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-info"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-info" href="?m=periode"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
            
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#tgl_periode').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
              format: 'YYYY-MM-DD'
            },
         "alwaysShowCalendars": true,
    }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
</script>
 <?php include "includes/footer.php"; ?>