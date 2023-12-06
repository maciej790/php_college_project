<?php
include 'polaczenie.php';
$id = $_GET['id'];
$sql = "UPDATE `notatki` SET   `tytul` = NULL, `tresc` = NULL, `data`=NULL WHERE `id`='$id';";
mysqli_query($polaczenie, $sql);
header('Location: index.php');
