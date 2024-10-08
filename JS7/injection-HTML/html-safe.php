<?php
$input = $_POST['input'];

$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
?>
<br><br><br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah input adalah email yang valid
    $email = $_POST['email'];

    // Validasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Lanjutkan dengan pengolahan email yang aman
        echo "Email valid: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    } else {
        // Tangani input yang tidak valid
        echo "Email tidak valid!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Email</title>
</head>
<body>
    <h2>Validate Email Input</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
