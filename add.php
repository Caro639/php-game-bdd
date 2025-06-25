<?php
include 'pdo.php';
// $pdo = include 'pdo.php';
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
        <!-- //formulaire d'ajout de jeu -->
        <h1>Ajouter un nouveau jeu</h1>
        <form action="add.php" method="post">
            <label for="title">Titre du jeu :</label>
            <input type="text" id="title" name="title" placeholder="titre du jeu" required>

            <label for="genre">Genre du jeu :</label>
            <input type="text" id="genre" name="genre" placeholder="genre du jeu" required>

            <label for="platform">Plateforme du jeu :</label>
            <input type="text" id="platform" name="platform" placeholder="plateforme du jeu" required>

            <label for="rating">Note du jeu :</label>
            <input type="number" id="rating" name="rating" min="0" max="50" step="0.1" required>

            <div class="pt-3 text-center">
                <button type="submit" class="btn btn-info">Ajouter le jeu</button>
            </div>

        </form>
        <?php
        if (isset($_POST['title']) && isset($_POST['genre']) && isset($_POST['platform']) && isset($_POST['rating'])) {
            $title = htmlspecialchars($_POST['title']);
            $genre = htmlspecialchars($_POST['genre']);
            $platform = htmlspecialchars($_POST['platform']);
            $rating = htmlspecialchars($_POST['rating']);
            $sql = "INSERT INTO game (title, genre, platform, rating) VALUES (:title, :genre, :platform, :rating)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'title' => $title,
                'genre' => $genre,
                'platform' => $platform,
                'rating' => $rating
            ]);
            header('Location: index.php?success=1');
            exit;
        }
        ?>

        <div class="mt-4">
            <button class="btn btn-dark">
                <a href="index.php" class="btn btn-dark">Retour à l'accueil</a>
            </button>
        </div>
    </section>
</body>

</html>