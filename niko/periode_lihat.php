

<?php    
    $p_id = esc_field($_GET['p_id']);
    $rows_kriteria = $db->get_results("SELECT * FROM tb_kriteria 
        ORDER BY kode_kriteria");
    $rows_nilai = $db->get_results("SELECT * FROM tb_nilai_karyawan WHERE periode_id = '$p_id'
        GROUP BY kode_karyawan");
     $periode_name = $db->get_row("SELECT tgl_periode, nama_periode FROM tb_periode WHERE periode_id='$p_id' ");

    if (empty($rows_nilai)):
        echo "<h1>Tampaknya anda belum mengatur nilai karyawan. Silahkan atur pada menu <a href='?m=nilai_karyawan&p_id=".$p_id."'>disini</a></h1>.";
    else:
?>
<div class="page-header">
    <h1>Laporan Periode <?= $periode_name->nama_periode;?></h1>
</div>
<h3><?php echo $periode_name->tgl_periode;;?></h3>
<div class="panel panel-info">
    <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Hasil Analisa</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <?php
                            if(is_array($rows_kriteria)){
                                foreach ($rows_kriteria as $row) {
                                   ?>
                                   <th><?= $row->nama_kriteria;?></th>
                                   <?php
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no=0;
                            $arr_a = array();
                            if(is_array($rows_nilai)){
                                foreach($rows_nilai as $row){
                                    $nama_karyawan = $db->get_row("SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row->kode_karyawan' ");
                                    ?>
                                    <tr>
                                        <td><?=$nama_karyawan->nama_karyawan?></td>
                                        <?php
                                        $nilai_c = 0;
                                        $arr_c = array();
                                        $no = 0;
                                        if(is_array($rows_kriteria)){
                                            foreach ($rows_kriteria as $row_k) {
                                                $data_K = $db->get_row("SELECT nilai FROM tb_nilai_karyawan WHERE kode_karyawan='$row->kode_karyawan' AND kode_kriteria='$row_k->kode_kriteria' AND periode_id = '$p_id' "); 
                                               ?>
                                               <th><?= $data_K->nilai;?></th>
                                               <?php
                                                $no++;  
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tr>
                    </tbody> 
                </table>
            </div>
        </div>  
        <?php
        $array_total = array();
                if(is_array($rows_kriteria)){
                    foreach ($rows_kriteria as $row) {
                        $rows_pembagi = $db->get_results("SELECT * FROM tb_nilai_karyawan WHERE kode_kriteria='$row->kode_kriteria' AND periode_id = '$p_id' GROUP BY kode_karyawan ORDER BY kode_karyawan ");
                        $total_nilai = 0;
                        foreach ($rows_pembagi as $row_2) {
                            $pangkat = pow($row_2->nilai, 2);
                            $total_nilai += $pangkat;
                        }
                        $array_total[$row->kode_kriteria] = number_format(sqrt($total_nilai),3);
                    }
                }
                            $no=0;
                            $arr_bobot = array();
                            if(is_array($rows_nilai)){
                                foreach($rows_nilai as $row){
                                    $nama_karyawan = $db->get_row("SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row->kode_karyawan' ");
                                        if(is_array($rows_kriteria)){
                                            foreach ($rows_kriteria as $row_k) {
                                                 $data_K = $db->get_row("SELECT nilai FROM tb_nilai_karyawan WHERE kode_karyawan='$row->kode_karyawan' AND kode_kriteria='$row_k->kode_kriteria' AND periode_id = '$p_id' "); 
                                                $nilai_awal = number_format($data_K->nilai / $array_total[$row_k->kode_kriteria],3);
                                                $arr_bobot[$row_k->kode_kriteria][$row->kode_karyawan] = $nilai_awal;
                                            }
                                        }
                                }
                            }
                            $no=0;
                            $arr_normal_bobot = array();
                            if(is_array($rows_nilai)){
                                foreach($rows_nilai as $row){
                                    $nama_karyawan = $db->get_row("SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row->kode_karyawan' ");
                                        if(is_array($rows_kriteria)){
                                            foreach ($rows_kriteria as $row_k) {

                                                $bobot = $arr_bobot[$row_k->kode_kriteria][$row->kode_karyawan] * ($row_k->bobot /100);
                                               $arr_normal_bobot[$row_k->kode_kriteria][$row->kode_karyawan] = number_format($bobot,3);
                                               
                                            }
                                        }
                                }
                            }
                                $bobot_positif = array();
                                if(is_array($rows_kriteria)){
                                    foreach ($rows_kriteria as $row_k) {
                                        $post_data = false;
                                       if($row_k->attribut == 'benefit'){
                                            $post_data = max($arr_normal_bobot[$row_k->kode_kriteria]);
                                       }else {
                                            $post_data = min($arr_normal_bobot[$row_k->kode_kriteria]);
                                       }
                                       $bobot_positif[$row_k->kode_kriteria] = $post_data;
                                    }
                                }
                                 $bobot_negatif = array();
                                if(is_array($rows_kriteria)){
                                    foreach ($rows_kriteria as $row_k) {
                                       
                                        // echo $arr_bobot[$row_k->kode_kriteria].' = '.$row_k->bobot / 100;
                                        $post_data = false;
                                        if($row_k->attribut == 'benefit'){
                                            $post_data = min($arr_normal_bobot[$row_k->kode_kriteria]);
                                        }else {
                                            $post_data = max($arr_normal_bobot[$row_k->kode_kriteria]);
                                        }
                                       $bobot_negatif[$row_k->kode_kriteria] = $post_data;
                                    }
                                }
                            $no=0;
                            $arr_p = array();
                            if(is_array($rows_nilai)){
                                foreach($rows_nilai as $row){
                                    $nama_karyawan = $db->get_row("SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row->kode_karyawan' ");
                                            $a_jarak = 0;
                                            if(is_array($rows_kriteria)){
                                                foreach ($rows_kriteria as $row_k) {
                                                    $a = round($bobot_positif[$row_k->kode_kriteria] - $arr_normal_bobot[$row_k->kode_kriteria][$row->kode_karyawan],3);
                                                    $pos_jarak = pow($a,2);
                                                    $a_jarak += $pos_jarak;
                                                }
                                            }
                                            $a_jarak = number_format(sqrt($a_jarak),3);
                                            $b_jarak = 0;
                                            if(is_array($rows_kriteria)){
                                                foreach ($rows_kriteria as $row_k) {
                                                    $b = round($bobot_negatif[$row_k->kode_kriteria] - $arr_normal_bobot[$row_k->kode_kriteria][$row->kode_karyawan],3);
                                                    $neg_jarak = pow($b,2);
                                                    $b_jarak += $neg_jarak;
                                                }
                                            }
                                            $b_jarak =number_format(sqrt($b_jarak),3);
                                            $p_jarak = number_format($b_jarak / ($a_jarak + $b_jarak),3);
                                            $arr_p[$row->kode_karyawan] = $p_jarak;
                                }
                            }
                            ?>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Hasil Perangkingan</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Total</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no=1;
                            // print_r($bobot_negatif);
                            // $arr_p = 
                            arsort($arr_p);

                            if(is_array($arr_p)){
                                foreach($arr_p as $row => $key){
                                    $nama_karyawan = $db->get_row("SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row' ");
                                    // $update_karyawan = $db->query("UPDATE tb_karyawan SET total='".$key."',rank='".$no."' WHERE kode_karyawan='$row' ")
                                    ?>
                                    <tr>
                                        <td><?=$nama_karyawan->nama_karyawan?></td>
                                        <td>
                                            <?= $key;?>
                                        </td>
                                        <td>
                                            <?= $no;?>  
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                            }
                            ?>
                        </tr>
                    </tbody> 
                </table>    
            </div>   
        </div>
        <a class="btn btn-sm btn-info" href="cetak.php?p_id=<?=$p_id;?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        <a class="btn btn-info" href="?m=periode"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    </div>
    <?php include "includes/footer.php"; ?>
</div>
<?php endif?>
