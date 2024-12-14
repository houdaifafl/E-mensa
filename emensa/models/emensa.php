<?php
function gerichteuebersich(){
    $link = connectdb();

    if (!$link) {
        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }

    $sql = "SELECT name, preis_intern, preis_extern, GROUP_CONCAT(a.code SEPARATOR ', ') AS 'Allergien', bildname 
        FROM gericht LEFT JOIN gericht_hat_allergen a on id = a.gericht_id GROUP BY name LIMIT 5";

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Fehler bei der Abfrage: ", mysqli_error($link);
    }

    mysqli_close($link);
    return $result;
}
?>