<?php
include '../config.php';

if (isset($_POST['submit'])) {
    $soal = $_POST['soal'];
    $label = $_POST['label'];
    $tipe = $_POST['tipe'];

    $sql = "INSERT INTO soal (soal, label, tipe) VALUES ('$soal', '$label', '$tipe')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>

<h2>Tambah User</h2>

<form method="post" action="tambah.php">
    <label for="soal">Soal:</label><br>
    <input type="text" id="soal" name="soal"><br>
    <label for="label">label:</label><br>
    <input type="text" id="label" name="label"><br>
    <label for="label">Tipe:</label><br>
    <input type="text" id="tipe" name="tipe"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

<?php
$conn->close();
?>