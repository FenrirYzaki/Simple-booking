<?php
include 'config.php';

if(isset($_POST['delete'])) {
    $rowDelete = $_POST['rowDelete'];

    $dataBooking = " SELECT * FROM booking WHERE id = $rowDelete ";
    $hasilDataBooking = mysqli_query($conn, $dataBooking);
    $rowBooking = mysqli_fetch_assoc($hasilDataBooking);

    $hapusBooking = " DELETE FROM booking WHERE id = $rowDelete ";
    $hasilHapusBooking = mysqli_query($conn, $hapusBooking);

    $hapusSeat = " DELETE FROM seats WHERE nama_tipe = '{$rowBooking['tipe']}' AND seat_booked = '{$rowBooking['seat_booked']}' ";
    $hasilHapusSeat = mysqli_query($conn, $hapusSeat);

    header('location:table_booking.php');
    exit();
}

$dataBooking = " SELECT * FROM booking ";
$hasilData = mysqli_query($conn, $dataBooking);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking</title>

    <link href="css/style.css">
</head>

<body>
    <a href="admin_page.php">back</a> <br><br>
    <table border="1">
        <thead>
            <th> Nama </th>
            <th> NIK </th>
            <th> Telepon </th>
            <th> Tipe </th>
            <th> Harga </th>
            <th> No Seat </th>
            <th> Action </th>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($hasilData)) : ?>
                <tr>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['nik']; ?></td>
                    <td><?php echo $row['telepon']; ?></td>
                    <td><?php echo $row['tipe']; ?></td>
                    <td><?php echo 'Rp '.$row['harga']. '.000'; ?></td>
                    <td><?php echo $row['seat_booked']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="rowDelete" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
