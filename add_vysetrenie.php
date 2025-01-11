<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Pridať nové vyšetrenie</title>
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
    <h1 class="text-center mb-4">Pridať nové vyšetrenie</h1>
    <form action="insert_vysetrenie.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="pacient" class="form-label">Pacient</label>
            <select class="form-select" id="pacient" name="id_pacient" required>
                <option value="">Vyberte pacienta</option>
<?php
$spojenie = mysqli_connect("localhost", "root", "", "krajcovic");

if (!$spojenie) {
    die("Spojenie s databázou sa nepodarilo: " . mysqli_connect_error());
}

$sql = "SELECT ID_pacienta, Meno, Priezvisko FROM Pacient";
$result = mysqli_query($spojenie, $sql);

if (mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)):
?>
                <option value="<?php echo $row['ID_pacienta']; ?>">
                    <?php echo $row['Meno'] . ' ' . $row['Priezvisko']; ?>
                </option>
<?php
    endwhile;
endif;

mysqli_close($spojenie);
?>
            </select>
            <div class="invalid-feedback">Prosím vyberte pacienta.</div>
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Dátum</label>
            <input type="date" class="form-control" id="datum" name="datum" required>
            <div class="invalid-feedback">Prosím zadajte dátum.</div>
        </div>
        <div class="mb-3">
            <label for="typ" class="form-label">Typ vyšetrenia</label>
            <select class="form-select" id="typ" name="typ_vysetrenia" required>
                <option value="1">Všeobecné</option>
                <option value="2">Ortopedické</option>
                <option value="3">Očné</option>
                <option value="4">Kožné</option>
            </select>
            <div class="invalid-feedback">Prosím vyberte typ vyšetrenia.</div>
        </div>
        <div class="mb-3">
            <label for="cena" class="form-label">Cena (€)</label>
            <input type="number" step="0.01" class="form-control" id="cena" name="cena" required>
            <div class="invalid-feedback">Prosím zadajte cenu.</div>
        </div>
        <div class="mb-3">
            <label for="opakovana" class="form-label">Opakovaná kontrola</label>
            <select class="form-select" id="opakovana" name="opakovana_kontrola">
                <option value="N" selected>Nie</option>
                <option value="A">Áno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Pridať vyšetrenie</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Späť</a>
    </form>
</div>
<script>
    // Bootstrap validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
</body>
</html>
