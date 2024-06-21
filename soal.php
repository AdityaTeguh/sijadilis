<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">
                Hello World
            </h1>
            <p class="subtitle">
                My first website with <strong>Bulma</strong>!
            </p>
        </div>
    </section>
    <section>
        <?php
        session_start();

        include 'config.php';

        // try {
        //     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // } catch (PDOException $e) {
        //     echo "Koneksi gagal: " . $e->getMessage();
        //     die();
        // }

        // Ambil soal dari database
        $query = $conn->query("SELECT * FROM
        jawaban INNER JOIN soal ON jawaban.id_soal=soal.id_soal
        soal INNER JOIN soal_pilihan ON soal.id_soal=soal_pilihan.id_soal");
        $questions = $query->fetch_all(PDO::FETCH_ASSOC);
        $totalQuestions = count($questions);

        // Inisialisasi sesi untuk soal dan jawaban
        if (!isset($_SESSION['current_question'])) {
            $_SESSION['current_question'] = 0;
        }

        if (!isset($_SESSION['answers'])) {
            $_SESSION['answers'] = [];
        }

        // Proses jawaban ketika form disubmit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $question_id = $_POST['question_id'];
            $selected_option = $_POST['selected_option'];

            // Cari bobot jawaban yang dipilih
            foreach ($questions as $question) {
                if ($question['id'] == $question_id) {
                    $weight = $question['weight_' . strtolower($selected_option)];
                    break;
                }
            }

            // Simpan jawaban ke sesi
            $_SESSION['answers'][$question_id] = [
                'selected_option' => $selected_option,
                'weight' => $weight
            ];

            // Navigasi ke soal berikutnya atau sebelumnya
            if (isset($_POST['next'])) {
                $_SESSION['current_question']++;
            } elseif (isset($_POST['prev'])) {
                $_SESSION['current_question']--;
            }
        }

        // Ambil soal saat ini
        $current_question = $_SESSION['current_question'];
        $current_question_data = $questions[$current_question];

        // Hitung total nilai
        $total_score = 0;
        foreach ($_SESSION['answers'] as $answer) {
            $total_score += $answer['weight'];
        }

        ?>

        <form method="POST">
            <div>
                <p><?php echo $current_question_data['question']; ?></p>
                <input type="hidden" name="question_id" value="<?php echo $current_question_data['id']; ?>">
                <label>
                    <input type="radio" name="selected_option" value="A" required <?php echo isset($_SESSION['answers'][$current_question_data['id']]) && $_SESSION['answers'][$current_question_data['id']]['selected_option'] == 'A' ? 'checked' : ''; ?>>
                    <?php echo $current_question_data['option_a']; ?>
                </label>
                <label>
                    <input type="radio" name="selected_option" value="B" required <?php echo isset($_SESSION['answers'][$current_question_data['id']]) && $_SESSION['answers'][$current_question_data['id']]['selected_option'] == 'B' ? 'checked' : ''; ?>>
                    <?php echo $current_question_data['option_b']; ?>
                </label>
                <label>
                    <input type="radio" name="selected_option" value="C" required <?php echo isset($_SESSION['answers'][$current_question_data['id']]) && $_SESSION['answers'][$current_question_data['id']]['selected_option'] == 'C' ? 'checked' : ''; ?>>
                    <?php echo $current_question_data['option_c']; ?>
                </label>
                <label>
                    <input type="radio" name="selected_option" value="D" required <?php echo isset($_SESSION['answers'][$current_question_data['id']]) && $_SESSION['answers'][$current_question_data['id']]['selected_option'] == 'D' ? 'checked' : ''; ?>>
                    <?php echo $current_question_data['option_d']; ?>
                </label>
            </div>
            <div>
                <?php if ($current_question > 0) : ?>
                    <button type="submit" name="prev">Sebelumnya</button>
                <?php endif; ?>
                <?php if ($current_question < $totalQuestions - 1) : ?>
                    <button type="submit" name="next">Berikutnya</button>
                <?php else : ?>
                    <p>Total Score: <?php echo $total_score; ?></p>
                <?php endif; ?>
            </div>
        </form>
    </section>
</body>

</html>