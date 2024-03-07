<?php
include 'config.php';

if(isset($_POST['delete'])) {
    $rowDelete = $_POST['rowDelete'];

    $hapusBooking = " DELETE FROM booking WHERE id = $rowDelete ";
    $hasilHapusBooking = mysqli_query($conn, $hapusBooking);

    $hapusSeat = " DELETE FROM seats WHERE nama_tipe = (SELECT tipe FROM booking WHERE id = $rowDelete) AND seat_booked = (SELECT seat_booked FROM booking WHERE id = $rowDelete) AND status = 1 ";
    $hasilHapusSeat = mysqli_query($conn, $hapusSeat);

    header('location:table_booking.php');
    exit();
}

$dataBooking = " SELECT * FROM booking ";
$hasilData = mysqli_query($conn, $dataBooking);

?>






