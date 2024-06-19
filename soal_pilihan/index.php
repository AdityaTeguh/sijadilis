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
  $sql = "SELECT * FROM soal_pilihan INNER JOIN soal On soal_pilihan.id_soal=soal.id_soal";  //  nama tabel dan kolom
  $result = $conn->query($sql);
  ?>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Laman Pilihan Jawaban
      </h1>
      <p class="subtitle">
        Prototype <strong>Situasional Judgement Digital Literacy Scale </strong>
      </p>
    </div>
  </section>
  <section>
  <div class="container">
  <h2>Data Pilihan Jawaban</h2>

<table border="1">
    <tr>
        <th>Soal</th>
        <th>Jawaban</th>
        <th>Bobot</th>
        <th>Aksi</th>
    </tr>
    <?php
    
    if ($result->num_rows > 0) {
        // Output data setiap baris
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["soal"] . "</td>";
            echo "<td>" . $row["jawaban"] . "</td>";
            echo "<td>" . $row["bobot"] . "</td>";
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