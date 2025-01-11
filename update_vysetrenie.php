<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Úprava vyšetrenia</title>
<style>
  .center-message {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    color: #333;
  }
  .success-message {
    color: #c9cf05; /*color for success update */
  }
  .error-message {
    color: red; /* color for error update  */
  }
</style>
</head>
<body>
<?php
$spojenie = mysqli_connect("localhost", "root", "", "krajcovic");

if (!$spojenie) {
    die("Spojenie s databázou sa nepodarilo: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_vysetrenia = intval($_POST['id_vysetrenia']);
    $datum = mysqli_real_escape_string($spojenie, $_POST['datum']);
    $typ_vysetrenia = intval($_POST['typ_vysetrenia']);
    $cena = floatval($_POST['cena']);
    $opakovana_kontrola = mysqli_real_escape_string($spojenie, $_POST['opakovana_kontrola']);

    $sql = "UPDATE Vysetrenie
            SET datum = '$datum', typ_vysetrenia = $typ_vysetrenia, cena = $cena, opakovana_kontrola = '$opakovana_kontrola'
            WHERE ID_vysetrenia = $id_vysetrenia";

    if (mysqli_query($spojenie, $sql)) {
        echo "<div class='center-message success-message'>Vyšetrenie bolo úspešne aktualizované.<br>Počkajte o pár sekúnd sa vrátite na hlavnú stránku.</div>";
        echo '<meta http-equiv="refresh" content="3;url=index.php">';
    } else {
        echo "<div class='center-message error-message'>Chyba pri aktualizácii vyšetrenia: " . mysqli_error($spojenie) . "</div>";
    }
}

mysqli_close($spojenie);
?>
</body>
</html>
