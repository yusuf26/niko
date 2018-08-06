<div class="page-header">
    <h1>
        Nilai Karyawan Periode
        <?php

        function sortByWeight($a, $b)
        {
            $a = $a['amount'];
            $b = $b['amount'];

            if ($a == $b) return 0;
            return ($a < $b) ? -1 : 1;
        }

        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_karyawan 
            WHERE kode_karyawan LIKE '%$q%' 
                OR nama_karyawan LIKE '%$q%'
            ORDER BY kode_karyawan");

        $rows_kriteria = $db->get_results("SELECT * FROM tb_kriteria 
            WHERE parent = '0' ORDER BY kode_kriteria");


        $p_id = esc_field($_GET['p_id']);
        $rows_nilai = $db->get_results("SELECT * FROM tb_nilai_karyawan WHERE periode_id='$p_id' GROUP BY kode_karyawan");
        // print_r($rows_nilai);
        
        $periode_name = $db->get_row("SELECT tgl_periode, nama_periode FROM tb_periode WHERE periode_id='$p_id' ");
        echo $periode_name->nama_periode;
        ?>
    </h1>
    <h3><?php echo $periode_name->tgl_periode;;?></h3>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="karyawan" />
        <div class="form-group">
            <a class="btn btn-primary" href="?m=nilai_karyawan_tambah&p_id=<?= $p_id;?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            
            
        </div>
    </form>
</div>
<div class="table-responsive">
    <?php
    $a=array();
    if(!empty($rows_nilai)){
        $no=1;
        foreach($rows_nilai as $row){
            $nama_karyawan = $db->get_row(" SELECT concat(kode_karyawan, '-', nama_karyawan) as nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$row->kode_karyawan' ");
            
            if(is_array($rows_kriteria)){
                $total = 0;
                $kriteria =array();
                foreach ($rows_kriteria as $row_k) {

                     $data_K = $db->get_results("SELECT nilai,kode_kriteria FROM tb_nilai_karyawan WHERE kode_karyawan='$row->kode_karyawan' AND kode_kriteria LIKE '%$row_k->kode_kriteria%'"); 
                     $bobot_cat = $db->get_row(" SELECT bobot FROM tb_kriteria WHERE kode_kriteria='$row_k->kode_kriteria' ");
                    // print_r($data_K);
                    $nilai_cat = 0;
                    foreach ($data_K as $value) {
                        $bobot = $db->get_row(" SELECT bobot FROM tb_kriteria WHERE kode_kriteria='$value->kode_kriteria' ");
                        $nilai_nik = $value->nilai * $bobot->bobot;
                        // echo $value->kode_kriteria.' = '.$nilai_nik.'<br />';
                        $nilai_cat += $nilai_nik;
                    }

                   $get_total = $nilai_cat * $bobot_cat->bobot;
                   $kriteria[$row_k->kode_kriteria] = $get_total;
                   //  'nilai' => ,
                   // );
                   $total += $get_total;
                   
                }
                $total = strval($total);
                $a[$total] =  array(
                        'nama_karyawan' => $nama_karyawan->nama_karyawan,
                        'kode_karyawan' => $row->kode_karyawan,
                        'periode_id' => $row->periode_id,
                        'kriteria' => $kriteria,
                        'amount' => $total 
                    );
            }
            $no++;
        }
    }

    // echo '<pre>';
    krsort($a);
    // print_r($a);
    // echo '</pre>';
    // print_r($rows_nilai);
    ?>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <!-- <th>No</th>         -->
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
            <th>Total</th>
            <th>Ranking</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if(!empty($a)){
            $no=1;
            foreach ($a as $key => $row) {
                
                ?>
                <tr>
                    <!-- <td><?= $no;?></td> -->
                    <td><?= $row['nama_karyawan'];?></td>
                    <?php
                    foreach ($row['kriteria'] as $key_2 => $row_2) {
                        ?>
                        <td><?= $row_2;?></td>
                        <?php
                    }
                    ?>
                    <td><?= $row['amount'];?></td>
                    <td><?= $no;?></td>
                    <td> 
                        <!-- <a class="btn btn-xs btn-info" href="?m=nilai_karyawan_ubah&p_id=<?= $p_id;?>&id=<?php echo $row->kode_karyawan?> "><span class="glyphicon glyphicon-edit"></span> Ubah</a> -->
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=nilai_karyawan_hapus&ID=<?=$row['kode_karyawan'].'&p_id='.$row['periode_id'];?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
       ?>   
    </tbody>
    </table>

    </div>
</div>
 
        <div class="form-group">
             <a class="btn btn-info" href="?m=periode"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </div>

<?php include "includes/footer.php"; ?>