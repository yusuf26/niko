<?php
require_once'functions.php';

/** LOGIN **/
if($act=='login'){
    $user = esc_field($_POST[user]);
    $pass = esc_field($_POST[pass]);
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION[login] = $row->user;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    } 
}else if ($mod=='password'){
    $pass1 = $_POST[pass1];
    $pass2 = $_POST[pass2];
    $pass3 = $_POST[pass3];
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif($pass2!=$pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
}elseif($act=='logout'){
    unset($_SESSION[login]);
    header("location:login.php");
} 
/** KARYAWAN **/
elseif($mod=='karyawan_tambah'){
    $kode_karyawan = $_POST['kode_karyawan'];
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $departemen = $_POST['departemen'];
    if($kode_karyawan=='' || $nama_karyawan=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_karyawan (kode_karyawan, nik, nama_karyawan, departemen) VALUES ('$kode_karyawan', '$nik', '$nama_karyawan', '$departemen')");
        
        $rows = $db->get_results("SELECT kode_kriteria FROM tb_kriteria");
        
        redirect_js("index.php?m=karyawan");
    }
} elseif ($mod=='karyawan_ubah'){
    $kode_karyawan = $_POST['kode_karyawan'];
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $departemen = $_POST['departemen'];
    if($kode_karyawan=='' || $nama_karyawan=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan' AND kode_karyawan<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("UPDATE tb_karyawan SET kode_karyawan='$kode_karyawan', nik='$nik', nama_karyawan='$nama_karyawan', departemen='$departemen' WHERE kode_karyawan='$_GET[ID]'");
        redirect_js("index.php?m=karyawan");
    }
} elseif ($act=='karyawan_hapus'){
    $db->query("DELETE FROM tb_karyawan WHERE kode_karyawan='$_GET[ID]'");
    header("location:index.php?m=karyawan");
} 

/** KRITERIA */    
if($mod=='kriteria_tambah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $attribut = $_POST['attribut'];
    $bobot = $_POST['bobot'];
    if($kode_kriteria=='' || $nama_kriteria=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, attribut, bobot) VALUES ('$kode_kriteria', '$nama_kriteria', '$attribut', '$bobot')");            
        redirect_js("index.php?m=kriteria");
    }    
} else if($mod=='kriteria_ubah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $attribut = $_POST['attribut'];
    $bobot = $_POST['bobot'];
    if($kode_kriteria=='' || $nama_kriteria=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria' AND kode_kriteria<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("UPDATE tb_kriteria SET kode_kriteria='$kode_kriteria', nama_kriteria='$nama_kriteria', attribut='$attribut', bobot='$bobot' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }    
} else if ($act=='kriteria_hapus'){
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
} 

// Function Tambah Nilai Alernatif
else if($mod == 'nilai_karyawan_tambah'){

    $kode_karyawan = $_POST['kode_karyawan'];
    $periode_id = $_POST['periode_id'];
    $count_kriteria = $_POST['count_kriteria'];
    for ($i=1; $i <=$count_kriteria ; $i++) { 
        $nilai = $_POST['nilai_'.$i];
        $kode_kriteria = $_POST['kriteria_'.$i];
        $db->query("INSERT INTO tb_nilai_karyawan (kode_kriteria, kode_karyawan, nilai, periode_id) VALUES ('$kode_kriteria', '$kode_karyawan', '$nilai', '$periode_id')");
    }
    redirect_js("index.php?m=nilai_karyawan&p_id=$periode_id");

}

else if($mod == 'nilai_karyawan_ubah'){
    $kode_karyawan = $_POST['kode_karyawan'];
    $count_kriteria = $_POST['count_kriteria'];
    for ($i=1; $i <=$count_kriteria ; $i++) { 
        $nilai = $_POST['nilai_'.$i];
        $kode_kriteria = $_POST['kriteria_'.$i];
        $id = $_POST['id_'.$i];

        $db->query("UPDATE tb_nilai_karyawan SET  nilai='$nilai' WHERE id='$id' AND kode_kriteria='$kode_kriteria' ");
    }

    redirect_js("index.php?m=nilai_karyawan");
} 
else if ($act=='nilai_karyawan_hapus'){

$db->query("DELETE FROM tb_nilai_karyawan WHERE kode_karyawan='$_GET[ID]'");
header("location:index.php?m=nilai_karyawan&p_id=$_GET[p_id]");

// Periode

} else if($mod == 'periode_tambah'){

    $created_dt = date('Y-m-d H:i:s');
    $nama_periode = $_POST['nama_periode'];
    $tgl_periode = $_POST['tgl_periode'];
    $keterangan = $_POST['keterangan'];

    $db->query("INSERT INTO tb_periode (nama_periode, tgl_periode, keterangan, created_dt) VALUES ('$nama_periode', '$tgl_periode', '$keterangan', '$created_dt')");

    redirect_js("index.php?m=periode");
    
} else if ($mod=='periode_ubah'){
    $periode_id = $_POST['periode_id'];
    $nama_periode = $_POST['nama_periode'];
    $keterangan = $_POST['keterangan'];
    $tanggal_periode = $_POST['tanggal_periode'];
    if($periode_id=='' || $nama_periode=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_periode WHERE periode_id='$periode_id' AND periode_id<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("UPDATE tb_periode SET periode_id='$periode_id', nama_periode='$nama_periode', keterangan='$keterangan', tgl_periode='$tgl_periode' WHERE periode_id='$_GET[ID]'");
        redirect_js("index.php?m=periode");
    }
}else if ($act=='periode_hapus'){

    $db->query("DELETE FROM tb_periode WHERE periode_id='$_GET[ID]'");
    header("location:index.php?m=periode");

}  