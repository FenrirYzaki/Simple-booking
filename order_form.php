<?php
session_start();

if (isset($_SESSION['admin_name'])) {
    $page_kembali = 'admin_page.php';
} else {
    $page_kembali = 'user_page.php';
}

include 'config.php';
include 'function/orderFunction.php';

$tipekelas = " SELECT * FROM tipe ";
$hasiltipe = mysqli_query($conn, $tipekelas);

if($hasiltipe) {
    $option = "";

    while($row = mysqli_fetch_assoc($hasiltipe)) {
        $option .= "<option value='{$row['nama_tipe']}'>";
    }
}

$totalSeat = 10;
$seatTersedia = range(1, $totalSeat);

if(isset($_POST['submit'])) {
    if(handleOrder($_POST, $conn)) {
        $success = 'Pesanan Berhasil';
    };
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <div class="customer">

        <form action="" method="post" id="orderForm">
            <h3>Order Ticket</h3>
            <h4>Nama :</h4> <input type="text" name="nama" min="3" max="50" required>
            <h4>NIK :</h4> <input type="number" name="nik" maxlength="18" required>
            <h4>Telepon :</h4> <input type="number" name="telepon" min="12" required>
            <h4>Tipe :</h4> <input list="tipe" name="tipe" required >
                <datalist id="tipe"> 
                    <?php echo $option; ?>
                </datalist>
            <h4>Seat :</h4> 
            <table>
                <tr>
                <?php
                    foreach ($seatTersedia as $seat) {
                        echo "<td><input type='radio' name='seat' value='$seat'>$seat</td>";
                    }
                ?>
                </tr>
            </table>
            <input type="submit" name="submit" value="order" class="form-btn">
            <?php
                if(isset($_SESSION['error'])) {
                    foreach($_SESSION['error'] as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                } elseif (isset($success)) {
                    echo '<span class="error-msg">'.$success.'</span>';
                }
                // if(isset($error)) {
                //     foreach($error as $error) {
                //         echo '<span class="error-msg">'.$error.'</span>';
                //     }
                // } elseif (isset($success)) {
                //     foreach($success as $success) {
                //         echo '<span class="error-msg">'.$success.'</span>';
                //     }
                // }
            ?>
            <a href="<?php echo $page_kembali ?>" class="btn">Kembali</a> ||
            <a href="logout.php" class="btn">Logout</a>
            
        </form>

    </div>

    <!-- <div class="list">

        <form action="">

            <h3>Harga Tike</h3>


        </form>

    </div> -->
    
</body>
</html>


<!-- <div class="seat">
                <table id="seatsDiagram">
                <tr>
                    <td><input type="radio" name="seat" id="seat-1" value="1">1</td>
                    <td><input type="radio" name="seat" id="seat-2" value="2">2</td>
                    <td><input type="radio" name="seat" id="seat-3" value="3">3</td>
                    <td><input type="radio" name="seat" id="seat-4" value="4">4</td>
                    <td><input type="radio" name="seat" id="seat-5" value="5">5</td>
                </tr>
                <tr>
                    <td><input type="radio" name="seat" id="seat-6" value="6">6</td>
                    <td><input type="radio" name="seat" id="seat-7" value="7">7</td>
                    <td><input type="radio" name="seat" id="seat-8" value="8">8</td>
                    <td><input type="radio" name="seat" id="seat-9" value="9">9</td>
                    <td><input type="radio" name="seat" id="seat-10" value="10">10</td>
                </tr>
                </table>
            </div> -->