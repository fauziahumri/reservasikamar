<?php
    error_reporting(0);
    include 'config/koneksi.php';
    
    require_once 'component/header.php';
    require_once 'component/navbar.php';
    $tglcheckin = isset($_POST['tglcheckin']);
    $tglcheckout = isset($_POST['tglcheckout']);
    $totalkamar = isset($_POST['totalkamar']);
    $breakfast = isset($_POST['breakfast']);

?>

<div class="container-fluid min-vh-100 bg-silver mt-5 py-5">
    <div class="row">
        <div class='col-12 col-md-2 col-lg-2'></div>
        <div class='col-12 col-md-8 col-lg-8'>
            <div class='bg-white p-3 rounded'>
                <h4>Form Pemesanan</h4>
                <hr>
                <form action="api/cetak-reservasi.php" method='POST'>
                    <label class='mb-2'>Nama Pemesan: </label>
                    <input required class='form-control shadow-none mb-3' name='nmpelanggan'>
                    <label class='mb-2'>Jenis Kelamin:    </label>
                    <input type="radio" name="jeniskelamin" value="Laki-laki" required> Laki-laki
                    <input type="radio" name="jeniskelamin" value="Perempuan" required> Perempuan<br>
                    <label class='mb-2'>Nomor Identitas: </label>
                    <input type="number" required class='form-control shadow-none mb-3' pattern="\d{16}" title="Isian salah, data harus 16 digit angka" name='nik'>
                    <label class='mb-2'>Tipe Kamar: </label>
                    <select name="tipekamar" class='form-select mb-3'>
                    <?php
                        $sql = mysqli_query($koneksi, "SELECT * FROM kamar");
                        while($r = mysqli_fetch_array($sql)) {
                    ?>
                        <option <?php echo $_GET['tipe'] = $r['tipekamar'] ? 'selected' : ''?> value="<?php echo $r['tipekamar'] ?>"><?php echo $r['tipekamar'] ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <label class='mb-2'>Tanggal CheckIN: </label>
                    <input required value='<?php echo $tglcheckin ? $_POST['tglcheckin'] : ''?>' class='form-control shadow-none mb-3' name='tglcheckin' type='date'>
                    <label class='mb-2'>Tanggal Checkout: </label>
                    <input required value='<?php echo $tglcheckout ? $_POST['tglcheckout'] : ''?>' class='form-control shadow-none mb-3' name='tglcheckout' type='date'>
                    <label class='mb-2'>Total Kamar: </label>
                    <input required value='<?php echo $totalkamar ? $_POST['totalkamar'] : ''?>' class='form-control shadow-none mb-3' name='totalkamar' type='number'>
                    <td>Termasuk Breakfast</td>
				    <input required type="checkbox" name="breakfast" value="ya" <?php if(isset($_POST['breakfast']) && $_POST['breakfast'] == 'ya') echo 'checked'; ?>> Ya <br><br>
                    
                    <button type="button" class='btn btn-cancel shadow-none' onclick="batal()">Cancel</button>
                    <button type='submit' class='btn btn-success shadow-none'>Hitung Total Bayar</button>
                
                </form>

                <script>
                    function batal() {
                        window.location.href = "index.php";
                    }
                </script>

            </div>
        </div>
        <div class='col-12 col-md-2 col-lg-2'></div>
    </div>
</div>
