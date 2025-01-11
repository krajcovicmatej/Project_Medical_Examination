<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Upraviť vyšetrenie</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
  .container {
    max-width: 800px;
    margin-top: 50px;
  }
</style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Upraviť vyšetrenie</h1>
<?php
$id_vysetrenia = intval($_GET['id']);

$spojenie = mysqli_connect("localhost", "root", "", "krajcovic");

if (!$spojenie) {
    die("Spojenie s databázou sa nepodarilo: " . mysqli_connect_error());
}

$sql = "
    SELECT datum, typ_vysetrenia, cena, opakovana_kontrola, ID_pacienta
    FROM Vysetrenie
    WHERE ID_vysetrenia = $id_vysetrenia";

$result = mysqli_query($spojenie, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Vyšetrenie s ID $id_vysetrenia neexistuje.");
}

$vysetrenie = mysqli_fetch_assoc($result);
?>
    <form action="update_vysetrenie.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="id_vysetrenia" value="<?php echo $id_vysetrenia; ?>">
        <div class="mb-3">
            <label for="datum" class="form-label">Dátum</label>
            <input type="date" class="form-control" id="datum" name="datum" value="<?php echo $vysetrenie['datum']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="typ" class="form-label">Typ vyšetrenia</label>
            <select class="form-select" id="typ" name="typ_vysetrenia" required>
                <option value="1" <?php echo ($vysetrenie['typ_vysetrenia'] == 1) ? 'selected' : ''; ?>>Všeobecné</option>
                <option value="2" <?php echo ($vysetrenie['typ_vysetrenia'] == 2) ? 'selected' : ''; ?>>Ortopedické</option>
                <option value="3" <?php echo ($vysetrenie['typ_vysetrenia'] == 3) ? 'selected' : ''; ?>>Očné</option>
                <option value="4" <?php echo ($vysetrenie['typ_vysetrenia'] == 4) ? 'selected' : ''; ?>>Kožné</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cena" class="form-label">Cena (€)</label>
            <input type="number" step="0.01" class="form-control" id="cena" name="cena" value="<?php echo $vysetrenie['cena']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="opakovana" class="form-label">Opakovaná kontrola</label>
            <select class="form-select" id="opakovana" name="opakovana_kontrola">
                <option value="N" <?php echo ($vysetrenie['opakovana_kontrola'] == 'N') ? 'selected' : ''; ?>>Nie</option>
                <option value="A" <?php echo ($vysetrenie['opakovana_kontrola'] == 'A') ? 'selected' : ''; ?>>Áno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Uložiť zmeny</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Späť</a>
    </form>
</div>
</body>
</html>
