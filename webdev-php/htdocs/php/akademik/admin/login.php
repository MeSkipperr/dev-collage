<?php

if (isset($_GET['pesan'])) {

    if ($_GET['pesan'] == "login") {

        header("Location: menu_akademik.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Membuat Login Dengan PHP dan MySQLi</title>
</head>

<body>

    <h2>Login User dengan Session</h2>

    <br>

    <!-- Cek pesan notifikasi -->
    <?php

    if (isset($_GET['pesan'])) {

        if ($_GET['pesan'] == "gagal") {

            echo "Login gagal! Username dan password salah!";

        } elseif ($_GET['pesan'] == "belum_login") {

            echo "Anda harus login untuk mengakses halaman admin";
        }
    }

    ?>

    <br><br>

    <form method="post" action="cek_login.php">

        <table>

            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                    >
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                    >
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="LOGIN">
                </td>
            </tr>

        </table>

    </form>

</body>
</html>