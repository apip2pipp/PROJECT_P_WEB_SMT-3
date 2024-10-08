<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <form id="myForm" method="post" action="proses_validasi.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br>

        <input type="submit" value="Submit">
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function () {
            $("#myForm").submit(function (event) {
                event.preventDefault(); // Prevent the form from submitting traditionally

                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var valid = true;

                // Reset error messages
                $("#nama-error").text("");
                $("#email-error").text("");
                $("#password-error").text("");

                // Validation checks
                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                }
                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                }
                if (password.length < 8) {
                    $("#password-error").text("Password harus memiliki minimal 8 karakter.");
                    valid = false;
                }

                if (valid) {
                    // Use AJAX to send data to the server if the form is valid
                    $.ajax({
                        url: 'proses_validasi.php',
                        type: 'POST',
                        data: { nama: nama, email: email, password: password },
                        success: function (response) {
                            // Display server response in the result div
                            $("#result").html(response);
                        },
                        error: function () {
                            $("#result").html("Error submitting data.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = array();

    // Validasi Nama
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    // Validasi Email
    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Validasi Password
    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password harus memiliki minimal 8 karakter.";
    }

    // Jika ada kesalahan validasi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Lanjutkan dengan pemrosesan data jika semua validasi berhasil
        echo "Data berhasil dikirim: Nama = $nama, Email = $email";
    }
}
?>
