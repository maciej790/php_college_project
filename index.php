<?php
session_start();
include 'polaczenie.php';
if ($_SESSION['zalogowany'] == false) {
    header('Location: login.php');
    exit();
}
$rezultat = mysqli_query($polaczenie, $_SESSION['sql']);
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <header>
            <h1>Notatnik w PHP</h1>
            <ul>
                <li><a href="index.php">Notatki</a></li>
                <li><a href="dodaj.php">Dodaj Notatkę</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </header>
        <main>
            <?php
            echo "<h2 class='witaj'>" . "Witaj" . ' ' . $_SESSION['login'] . "</h2>";
            foreach ($rezultat as $wiersz) {
                if ($wiersz['tytul'] && $wiersz['tresc']) {
                    echo '<div class="notatka">';
                    echo '<div class="tytul">';
                    echo '<h2>' . $wiersz['tytul'] . '</h2>';
                    echo '<h3>' . $wiersz['login'] . '</h3>';
                    echo '<h3>' . $wiersz['data'] . '</h3>';
                    echo '</div>';
                    echo '<a href="usun.php?id=' . $wiersz['id'] . '">' . 'Usuń' . '</a>';
                    echo '<div class="tresc">' . $wiersz['tresc'] . '</div>';
                    echo '</div>';
                }
            }
            ?>
        </main>
    </div>
</body>

</html>