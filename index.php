<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<title>Zoznam vyšetrení</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
  table.dataTable {
    width: 100% !important;
  }
  .fixed-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
  }
</style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Zoznam vyšetrení</h1>

    
    <table id="vysetreniaTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID Vyšetrenia</th>
                <th>Pacient</th>
                <th>Dátum</th>
                <th>Typ Vyšetrenia</th>
                <th>Cena (€)</th>
                <th>Opakovaná kontrola</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
<?php
$spojenie = mysqli_connect("localhost", "root", "", "krajcovic");

if (!$spojenie) {
    die("Spojenie s databázou sa nepodarilo: " . mysqli_connect_error());
}

$typ_map = [
    1 => "Všeobecné",
    2 => "Ortopedické",
    3 => "Očné",
    4 => "Kožné",
];

$sql = "
    SELECT 
        Vysetrenie.ID_vysetrenia,
        CONCAT(Pacient.Meno, ' ', Pacient.Priezvisko) AS Pacient,
        Vysetrenie.datum,
        Vysetrenie.typ_vysetrenia,
        Vysetrenie.cena,
        Vysetrenie.opakovana_kontrola
    FROM Vysetrenie
    LEFT JOIN Pacient ON Vysetrenie.ID_pacienta = Pacient.ID_pacienta
    ORDER BY Vysetrenie.datum DESC";

$result = mysqli_query($spojenie, $sql);

if (mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)):
?>
            <tr>
                <td><?php echo $row['ID_vysetrenia']; ?></td>
                <td><?php echo $row['Pacient']; ?></td>
                <td><?php echo $row['datum']; ?></td>
                <td><?php echo $typ_map[$row['typ_vysetrenia']] ?? "Neznámy typ"; ?></td>
                <td><?php echo $row['cena']; ?></td>
                <td><?php echo ($row['opakovana_kontrola'] === 'A') ? 'Áno' : 'Nie'; ?></td>
                <td>
                    <a href="edit_vysetrenie.php?id=<?php echo $row['ID_vysetrenia']; ?>" class="btn btn-warning btn-sm">Upraviť</a>
                    <a href="delete_vysetrenie.php?id=<?php echo $row['ID_vysetrenia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Naozaj chcete vymazať toto vyšetrenie?');">Vymazať</a>
                </td>
            </tr>
<?php
    endwhile;
else:
?>
            <tr>
                <td colspan="7" class="text-center">Žiadne vyšetrenia neboli nájdené.</td>
            </tr>
<?php
endif;

mysqli_close($spojenie);
?>
        </tbody>
    </table>
</div>


<div class="fixed-button">
    <a href="add_vysetrenie.php" class="btn btn-primary btn-lg">Pridať nové vyšetrenie</a>

</div>


<script>
$(document).ready(function () {
    $('#vysetreniaTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/slovak.json'
        },
        paging: true,
        ordering: true,
        info: true,
        searching: true 
    });
});
</script>
</body>
</html>
