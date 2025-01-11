<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Pridávanie vyšetrenia</title>
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
    color: #45cf05; /*color for success insert */
  }
  .error-message {
    color: red; /*color for error insert */
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
    $id_pacient = intval($_POST['id_pacient']);
    $datum = mysqli_real_escape_string($spojenie, $_POST['datum']);
    $typ_vysetrenia = intval($_POST['typ_vysetrenia']);
    $cena = floatval($_POST['cena']);
    $opakovana_kontrola = mysqli_real_escape_string($spojenie, $_POST['opakovana_kontrola']);

    $sql = "INSERT INTO Vysetrenie (datum, typ_vysetrenia, cena, opakovana_kontrola, ID_pacienta) 
            VALUES ('$datum', $typ_vysetrenia, $cena, '$opakovana_kontrola', $id_pacient)";

    if (mysqli_query($spojenie, $sql)) {
        echo "<div class='center-message success-message'>Vyšetrenie bolo úspešne pridané.<br>Počkajte o pár sekúnd sa vrátite na hlavnú stránku.</div>";
        echo '<meta http-equiv="refresh" content="3;url=index.php">';
    } else {
        echo "<div class='center-message error-message'>Chyba pri pridávaní vyšetrenia: " . mysqli_error($spojenie) . "</div>";
    }
}

mysqli_close($spojenie);
?>
</body>
</html>
