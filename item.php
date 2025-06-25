<?php
include 'pdo.php';

$game_id = $_GET['game_id'];

var_dump($game_id);

$sql = "SELECT * FROM game WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $game_id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($game);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <section>
        <h1>Détail du jeu <?php echo $game['title']; ?></h1>

        <p>Genre du jeu : <?php echo $game['genre']; ?></p>
        <p>Plateforme de jeu : <?php echo $game['platform']; ?></p>
        <p>Note du jeu : <?php echo $game['rating']; ?></p>

        <div class="pt-3 text-center">
            <button class="btn btn-dark">
                <a href="index.php" class="btn btn-dark">Retour à l'accueil</a>
            </button>
        </div>
    </section>
</body>

</html>