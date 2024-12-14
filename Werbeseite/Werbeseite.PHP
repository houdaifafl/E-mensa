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
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
    <div id="grid-template">
        <div><img src="mensalogo.jpg" alt="logo" class="mensa_logo"></div>
        <div class="navi">
            <a href="#ankündigung" class="attribute">Ankündigung</a>
            &emsp;
            &nbsp;
            <a href="#speisen" class="attribute">Speisen</a>
            &emsp;
            &nbsp;
            <a href="#bezahlen" class="attribute">Zahlen</a>
            &emsp;
            &nbsp;
            <a href="#kontakt" class="attribute">Kontakt</a>
            &emsp;
            &nbsp;
            <a href="#wichtig" class="attribute">Wichtig fur uns</a>
        </div>
    </div>
    <hr>
</header>

<div class="content">
    <div id="mensaphoto">
        <img src="mensa.jpg" alt="mensa">
    </div>
    <br>
    <div>
        <h2 id="ankündigung">Bald gibt es Essen auch online :)</h2>
        <p class="text1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
            nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
            Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
            porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
            Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.
            Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus,
            sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
            Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
            Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales
            sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
    </div>
    <br>
    <div>
        <h2 id = "speisen"> Köstlichkeiten, die Sie erwarten </h2>
        <table class="menu" border="1">
            <tr>
                <td>Gericht</td>
                <td>Preis intern</td>
                <td>Preis extern</td>
                <td>Allergens</td>

            </tr>
                <?php

                $sql = "SELECT name, preis_intern, preis_extern, GROUP_CONCAT(a.code SEPARATOR ',') AS 'allergen' 
                        FROM gericht LEFT JOIN gericht_hat_allergen a ON gericht.id = a.gericht_id
                        GROUP BY name ASC LIMIT 5";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>",
                    "<td>", $row['name'], "</td>",
                    "<td>", $row['preis_intern'], "€", "</td>",
                    "<td>", $row['preis_extern'], "€", "</td>",
                    "<td>", $row['allergen'], "</td>",
                    "</tr>";
                }
                
                mysqli_free_result($result);
                ?>
        </table>
    </div>
    <br>
    <div>
        <table>
            <h2 id = "bezahlen">E-Mensa in Zahlen</h2>
            <tr>
                <th id="m3"> <?php
                    $sqlUpdate = "UPDATE besucher SET anzahl = anzahl + 1";
                    $resultUpdate = mysqli_query($link, $sqlUpdate);

                    if ($resultUpdate) {
                        $sqlSelect = "SELECT anzahl FROM besucher";
                        $resultSelect = mysqli_query($link, $sqlSelect);

                        if ($resultSelect) {
                            if (mysqli_num_rows($resultSelect) > 0) {
                                $row = mysqli_fetch_row($resultSelect);
                                $updatedValue = $row[0];
                                echo "Total Visitors: $updatedValue";
                            } else {
                                echo "No rows found in the result.";
                            }
                        } else {
                            echo "Error fetching result: " . mysqli_error($link);
                        }
                    } else {
                        echo "Error updating value: " . mysqli_error($link);
                    }?> Besuche </th>
                <th id="m4"> <?php
                    $sql = "SELECT COUNT(*) FROM user_data";
                    $result = mysqli_query($link, $sql);
                    $out = mysqli_fetch_row($result);
                    echo $out[0];
                    ?> Anmeldungen zum Newsletter </th>
                <th id="m5"> <?php
                    $sql = "SELECT COUNT(*) FROM gericht";
                    $result = mysqli_query($link, $sql);
                    $out = mysqli_fetch_row($result);
                    echo $out[0];
                    ?> Speisen</th>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <h2>Intersse geweckt? wir informieren Sie!</h2>
        <form action="Newsletteranmeldung.php" method="post">
            <label for="vorname">Ihr Name:</label>
            <label for="email" class="mail">Ihre E-Mail:</label>
            <label for="newsletter" class="news">Newsletter bitte in:</label>
            <br>
            <input type="text" id="vorname" name="Vorname" placeholder="Vorname">
            <input type="text" id="email" name="Email" placeholder="Email">
            <select  id="newsletter">
                <option value="English">English</option>
                <option value="Deutsch" selected>Deutsch</option>
                <option value="Arabic">Arabic</option>
            </select>
            <br>
            <input type="checkbox" name="datenschutz" id="daten">
            <label for="daten">Den Datenschutzbestimmungen stimme ich zu</label>
            <input type="submit" name="anmelden" value="Zum Newsletter anmelden" id="sub">
        </form>
        <br>
        </form>
    </div>

    <div>
        <h2 id="wichtig">Das ist uns wichtig</h2>
        <ul id="lastlist">
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
    <br>
    <div>
        <h2 class="end">Wir freuen uns auf Ihre Besuch</h2>
    </div>
    <footer id="kontakt">
        <p class="n1"> &copy; E-Mensa GmbH | Houdaifa Fakih Lanjri | <a href=" " class="Impress"> Impressum </a></p>
    </footer>
    <!---->
</div>
</body>
</html>