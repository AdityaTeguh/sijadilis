<?php
include '..\config.php';

if (isset($_GET['id_soal'])) {
    $id = $_GET['id_soal'];
    // Ambil data berdasarkan ID
    $sql = "SELECT id_soal, soal, label, tipe FROM soal WHERE id_soal=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
    }
}

if (isset($_POST['update'])) {
    $id_soal = $_POST['id_soal'];
    $soal = $_POST['soal'];
    $label = $_POST['label'];
    $tipe = $_POST['tipe'];

    // Update data
    $sql = "UPDATE soal SET soal='$soal', label='$label', tipe='$tipe' WHERE id_soal=$id_soal";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Soal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">
                Ubah Soal
            </h1>
            <p class="subtitle">
                Prototype <strong>Situasional Judgement Digital Literacy Scale </strong>
            </p>
        </div>
    </section>
    <section class="section">
    <div class="container">
        <h2>Ubah Soal</h2>
        <form method="post" action="ubah.php">
            <input type="hidden" name="id_soal" value="<?php echo $row['id_soal']; ?>">
            <label for="soal">Soal :</label>
            <br>
            <input type="text" id="soal" name="soal" value="<?php echo $row['soal']; ?>">
            <br>
            <label for="label">Label:</label>
            <br>
            <input type="text" id="label" name="label" value="<?php echo $row['label']; ?>"> <br>            
            <label for="label">Tipe:</label>
            <br>
            <input type="text" id="tipe" name="tipe" value="<?php echo $row['tipe']; ?>">
            <br>
            <br>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>