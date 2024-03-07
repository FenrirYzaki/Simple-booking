<?php

function handleOrder($post, $conn) {
    $nama = mysqli_escape_string($conn, $post['nama']);
    $nik = mysqli_escape_string($conn, $post['nik']);
    $telepon = mysqli_escape_string($conn, $post['telepon']);
    $tipe = mysqli_escape_string($conn, $post['tipe']);
    $seat = mysqli_escape_string($conn, $post['seat']);

    $statusSeat = " SELECT * FROM seats WHERE nama_tipe = '$tipe' AND seat_booked = '$seat' AND status = 1 ";
    $hasilStatusSeat = mysqli_query($conn, $statusSeat);

    if (mysqli_num_rows($hasilStatusSeat) > 0) {
        $_SESSION['error'][] = 'Pilih seat yang lain';
        unset($_SESSION['error']);
    } else {

    $hargaTipe = " SELECT harga FROM tipe WHERE nama_tipe = '$tipe' ";
    $hasilHarga = mysqli_query($conn, $hargaTipe);

    if ($hasilHarga && mysqli_num_rows($hasilHarga) > 0) {
        $row = mysqli_fetch_assoc($hasilHarga);
        $harga = $row['harga'];

        $seatsInsert = " INSERT INTO seats (nama_tipe, seat_booked) VALUES ('$tipe', '$seat' ) ";
        mysqli_query($conn, $seatsInsert);

        $updateStatusSeat = " UPDATE seats SET status = 1 WHERE seat_booked = '$seat' ";
        mysqli_query($conn, $updateStatusSeat);

        $bookingInsert = " INSERT INTO booking (nik, nama_pelanggan, telepon, tipe, harga, seat_booked) VALUES ('$nik', '$nama', '$telepon', '$tipe', '$harga', '$seat') ";
        mysqli_query($conn, $bookingInsert);

        // if (isset($_SESSION['admin_name'])) {
        //     $page_kembali = 'admin_page.php';
        // } else {
        //     $page_kembali = 'user_page.php';
        // }

        // header('location'.$page_kembali);
    } else {
            $error[] = 'Tidak ada Harga pada Tipe Kelas yang dipilih';
        }
    }
}

?>