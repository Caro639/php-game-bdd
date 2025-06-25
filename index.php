<?php
// Connexion à la base de donnée
include 'pdo.php'; ?>
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

    <?php
    $sql = "SELECT * FROM game";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($games);
    
    ?>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1): ?>

        <div class="alert alert-success" role="alert">
            Jeu ajouté avec succès !
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="alert alert-success" role="alert">
            Jeu modifié avec succès !
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="alert alert-success" role="alert">
            Jeu supprimé avec succès !
        </div>
    <?php endif; ?>

    <section>
        <h1>Hello games</h1>

        <!-- barre de recherche -->
        <div class="search d-flex flex-row mb-3">
            <nav class="navbar bg-body-tertiary">
                <!-- <div class="container-fluid"> -->
                <form action="index.php" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search"
                        name="search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <!-- </div> -->
            </nav>
        </div>
        <?php
        if (isset($_GET['search']) && !empty($_GET['search'])): ?>
            <?php
            $search = htmlspecialchars($_GET['search']);
            var_dump($search);

            $sql = "SELECT * FROM game WHERE title LIKE :search";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'search' => ("%" . $search . "%")
            ]);
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($games);
            ?>
        <?php endif; ?>

        <h2>Liste des jeux</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Rating</th>
                <th>Voir le jeu</th>
                <!-- <th>Ajouter un jeu</th> -->
                <th>Modifier un jeu</th>
                <th>Supprimer un jeu</th>
            </tr>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?php echo $game['title'] ?></td>

                    <td><?php echo $game['genre'] ?></td>

                    <td><?php echo $game['platform'] ?></td>

                    <td><?php echo $game['rating'] ?></td>

                    <td>
                        <button class="btn btn-dark">
                            <a href="item.php?game_id=<?php echo $game['id']; ?>" class="show">Voir le jeu</a>
                        </button>
                    </td>

                    <td>
                        <button class="edit" data-bs-toggle="modal" data-bs-target="#edit<?php echo $game['id'] ?>">Modifier
                            le jeu</button>
                        <!-- <a href="edit.php?game_id=" class="edit">Modifier le jeu</a> -->
                    </td>
                    <td>
                        <button class="delete" data-bs-toggle="modal"
                            data-bs-target="#delete<?php echo $game['id'] ?>">Supprimer le
                            jeu</button>
                        <!-- <a href="delete.php?game_id=" class="delete" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Supprimer le jeu</a> -->
                    </td>
                </tr>
                <!-- Modal edit -->
                <div class="modal fade" id="edit<?php echo $game['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Etes-vous certain de vouloir modifier le jeu ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">
                                    <a href="edit.php?game_id=<?php echo $game['id']; ?>" class="link-light">Modifier le
                                        jeu</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal delete -->
                <div class="modal fade" id="delete<?php echo $game['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Etes-vous certain de vouloir supprimer le jeu ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">
                                    <a href="delete.php?game_id=<?php echo $game['id']; ?>" class="link-light">Validez la
                                        suppression</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </table>
        <div class="mt-4">
            <button class="btn btn-dark">
                <a href="add.php" class="btn btn-dark">Ajouter un jeu</a>
            </button>
        </div>

    </section>
</body>

</html>