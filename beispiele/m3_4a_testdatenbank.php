<?php
/**
 * Praktikum DBWT. Autoren:
 * Amro, Elsaadany, 3611597
 * Houdaifa, Fakih Lanjri ,3574047
 */

$link = mysqli_connect(
    "localhost",
    "root",
    "root",
    "emensawerbeseite"
);


if(!$link){
    echo "Verbindung fehlgeschlagen", mysqli_connect_error();
    exit();
}else {
    echo "Verbindung war erfolgreich";
}


$sql = "SELECT id, name, beschreibung FROM gericht";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "Fehler während der Abfrage: ", mysqli_error($link);
    exit();
}
while ($row = mysqli_fetch_assoc($result)) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Beschreibung</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>', $row['id'], '</td>';
        echo '<td>', $row['name'], '</td>';
        echo '<td>', $row['beschreibung'], '</td>';
        echo '</tr>';
    }

    echo '</table>';
}

mysqli_free_result($result);
mysqli_close($link);
