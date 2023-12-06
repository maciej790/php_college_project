<?php
session_start();
if ($_SESSION['zalogowany'] == true) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <form action="zarejestruj.php" method="post">
        login: <input type="text" name="login" />
        haslo: <input type="password" name="haslo_1" />
        powtorz haslo: <input type="password" name="haslo_2" />
        <input type="submit" name="zarejestruj" value="zarejestruj" />
    </form>

    <?php
    include 'polaczenie.php';

    if (isset($_POST['zarejestruj'])) {
        $login = $_POST['login'];
        $haslo_1 = $_POST['haslo_1'];
        $haslo_2 = $_POST['haslo_2'];

        if ($login && $haslo_1 && $haslo_2) {
            $sql = "SELECT * FROM notatki WHERE login = '$login'";
            $rezultat = mysqli_query($polaczenie, $sql);
            if (mysqli_num_rows($rezultat) > 0) {
                echo '<p class="error">' . 'Nazwa użytkownika jest już zajęta!' . '</p>';
            } else if ($haslo_1 == $haslo_2) {
                $sql = "INSERT INTO `notatki`(`id`, `login`, `haslo`) VALUES ('','$login','$haslo_1')";
                mysqli_query($polaczenie, $sql);
                $_SESSION['zalogowany'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['haslo'] = $haslo_1;
                $_SESSION['sql'] = "SELECT * FROM notatki WHERE login='$login'";
                header('Location: index.php');
            } else {
                echo '<p class="error">' . 'Hasła muszą być takie same!' . '</p>';
            }
        } else {
            echo '<p class="error">' . 'Uzupełnij pola!' . '</p>';
        }
    }

    ?>
</body>

</html>