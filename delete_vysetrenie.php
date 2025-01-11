<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Mazanie vyšetrenia</title>
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
    color: #cf3005;  /*color for success delete */
  }
  .error-message {
    color: red;   /*color for error delete */
  }
</style>
</head>
<body>
<?php
$spojenie = mysqli_connect("localhost", "root", "", "krajcovic");

if (!$spojenie) {
    die("Spojenie s databázou sa nepodarilo: " . mysqli_connect_error());
}

$id_vysetrenia = intval($_GET['id']);

$sql = "DELETE FROM Vysetrenie WHERE ID_vysetrenia = $id_vysetrenia";

if (mysqli_query($spojenie, $sql)) {
    echo "<div class='center-message success-message'>Vyšetrenie bolo úspešne vymazané.<br>Počkajte o pár sekúnd sa vrátite na hlavnú stránku.</div>";
    echo '<meta http-equiv="refresh" content="3;url=index.php">';
} else {
    echo "<div class='center-message error-message'>Chyba pri mazaní vyšetrenia: " . mysqli_error($spojenie) . "</div>";
}

mysqli_close($spojenie);
?>
</body>
</html>
