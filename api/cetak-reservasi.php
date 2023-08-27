<?php
    include '../config/koneksi.php';
    require_once '../component/header.php';

    $getID = '';


    $sql = mysqli_query($koneksi, "INSERT INTO booking VALUES ('', '$_POST[nmpelanggan]', '$_POST[nik]', '$_POST[jeniskelamin]', '$_POST[tglcheckin]', '$_POST[tglcheckout]', '$_POST[totalkamar]', '$_POST[tipekamar]', '$_POST[breakfast]')");

    if(!$sql) {
        echo "<script>alert('Gagal Membuat Reservasi!".mysqli_errno($koneksi)."')</script>";
    } else {
        $getID = mysqli_query($koneksi, "SELECT MAX(id) AS idpesanan FROM booking");
    }
?>

<div class="p-4">
    <h3 class='fw-bold mb-5'>RESERVASI BERHASIL</h3>
    <p>
        <b>
            <?php while($id=mysqli_fetch_array($getID)) {
                echo "ID RESERVASI " .$id['idpesanan'];
            } ?>
        </b>
    </p>
    <p>Nama: <?php echo $_POST['nmpelanggan'] ?></p>
    <p>Jenis Kelamin <?php echo $_POST['jeniskelamin'] ?></p>
    <p>Nomor Identitas: <?php echo $_POST['nik'] ?></p>
    <p>Tipe Kamar: <?php echo $_POST['tipekamar'] ?></p>
    <p>Tanggal CheckIN: <?php echo $_POST['tglcheckin'] ?></p>
    <p>Tanggal CheckOUT: <?php echo $_POST['tglcheckout'] ?></p>
    <p>Jumlah Kamar: <?php echo $_POST['totalkamar'] ?></p>
    <p>Termasuk Breakfast: <?php echo $_POST['breakfast'] ?></p>
    

    <?php
        $getBiayaSewa = mysqli_query($koneksi, "SELECT biayasewa FROM kamar WHERE tipekamar='$_POST[tipekamar]'");
        $r = mysqli_fetch_array($getBiayaSewa);
        $tgl1 = new DateTime($_POST['tglcheckin']);
        $tgl2 = new DateTime($_POST['tglcheckout']);
        $jarak = $tgl2->diff($tgl1)->days;
        
       // Total Bayar
        $total_bayar = $_POST['totalkamar'] * $r['biayasewa'] * $jarak;

        if ($jarak > 3) {
            $total_bayar *= 0.9; // Diskon 10% jika jarak > 3
        }

        if ($_POST['breakfast'] && $_POST['breakfast'] == 'ya') {
            // Biaya tambahan breakfast jika dipilih
            $total_bayar = $total_bayar + 80000;
        } else {
            $total_bayar;
        }

        $total_bayar = number_format($total_bayar, 0, '.', '.');

        echo "<p><b>Total Pembayaran: $total_bayar</b></p>";

            ?>

    
</div>

<button type="button" class='btn btn-cancel shadow-none' onclick="batal()">Back</button>
<script>
     function batal() {
          window.location.href = "../index.php";
       }
</script>
