<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Sijadilis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        SIJADILIS
      </h1>
      <p class="subtitle">
        Prototype <strong>Situasional Judgement Digital Literacy Scale </strong>
      </p>
        <p class="subtitle">
        Kembali ke Menu 
        <a href="../admin.php">Admin</a>
        </p>
    </div>
  </section>

  <?php
  include '../config.php';
  // Query untuk mengambil data dari tabel
  $sql = "SELECT * FROM soal INNER JOIN label ON soal.id_label=label.id_label";  //  nama tabel dan kolom
  $result = $conn->query($sql);
  ?>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Laman Soal
      </h1>
      <p class="subtitle">
        Prototype <strong>Situasional Judgement Digital Literacy Scale </strong>
      </p>
    </div>
  </section>
  <section>
  <div class="container">
  <h2>Data Soal</h2>

<table border="1">
    <tr>
        <th>Label</th>
        <th>Soal</th>
        <th>Tipe Soal</th>
        <th>Aksi</th>
    </tr>
    <?php
    
    if ($result->num_rows > 0) {
        // Output data setiap baris
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["label"] . "</td>";
            echo "<td>" . $row["soal"] . "</td>";
            echo "<td>" . $row["tipe"] . "</td>";
            echo "<td><a href='ubah.php?id=".$row["id_soal"]."'>Edit</a> | <a href='index.php?delete=".$row["id_soal"]."'>Hapus</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Tidak ada data ditemukan</td></tr>";
    }
    ?>
</table>
  </div>
  </section>
</body>

</html>

<?php
$conn->close();
?>