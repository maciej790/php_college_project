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
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <form action="login.php" method="post">
        login: <input type="text" name="login" />
        haslo: <input type="password" name="haslo" />
        <input type="submit" name="zaloguj" value="zaloguj" />
    </form>
    <?php
    include 'polaczenie.php';

    if (isset($_POST['zaloguj'])) {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        if ($login && $haslo) {
            $sql = "SELECT * FROM notatki WHERE login='$login' AND haslo='$haslo' ORDER BY id DESC";
            $zapytanie = mysqli_query($polaczenie, $sql);
            if (mysqli_num_rows($zapytanie) > 0) {
                unset($_SESSION['error']);
                $_SESSION['zalogowany'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['haslo'] = $haslo;
                $_SESSION['sql'] = $sql;
                header('Location: index.php');
            } else {
                unset($_SESSION['zalogowany']);
                $_SESSION['error'] = '<p class="error">' . 'Błędny login lub hasło!' . '</p>';
                echo $_SESSION['error'];
            }
        } else {
            echo '<p class="error">' . 'Uzupełnij pola!' . '</p>';
        }
    }

    ?>

    <h3 class="konto">
        <a href="zarejestruj.php">Lub jeśli nie masz konta zarejestruj się tutaj</a>
    </h3>
</body>

</html>