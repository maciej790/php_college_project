<?php
session_start();
$login = $_SESSION['login'];
$haslo = $_SESSION['haslo'];
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
    <div class="dodaj">
        <form action="dodaj.php" method="get">
            Tytuł: <input type="text" name="tytul" class="input_tytul" />
            Treść: <textarea class="input_tresc" name="tresc" rows="4" cols="50"></textarea>
            <input type="submit" name="wyslij" value="dodaj notatke" />
        </form>

        <?php
        include 'polaczenie.php';
        if (isset($_GET['wyslij'])) {
            if ($_GET['tresc'] && $_GET['tytul']) {
                $tytul = $_GET['tytul'];
                $tresc = $_GET['tresc'];
                $data = date("Y-m-d");
                $sql = "INSERT INTO `notatki`(`id`, `login`, `haslo`, `tytul`, `tresc`, `data`) VALUES ('', '$login', '$haslo','$tytul','$tresc','$data')";
                mysqli_query($polaczenie, $sql);
                header('Location: index.php');
            } else {
                echo '<p class="error">' . 'Uzupełnij pola!' . '</p>';
            }
        }
        ?>
    </div>
</body>

</html>