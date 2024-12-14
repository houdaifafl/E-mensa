<?php
/**
 *  Praktikum DBWT. Autoren:
 *  Amro, Elsaadany, 3611597
 *  Houdaifa, Fakih Lanjri ,3574047

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

$vorname ="";
$email = "";
$fehler=true;
$blacklist_domains = array('rcpt.at', 'damnthespam.at','wegwerfmail.de','trashmail.de','trashmail.com', 'example.com');
$domain = substr(strrchr($_POST["Email"],"@"),1);
if (isset ($_POST['anmelden'])  && empty($_POST['Vorname']))
{
    $fehler=false;
    echo "<span class='error'> <small> ! Bitte geben Sie ihre name ein.</small></span><br>";
}
elseif (isset ($_POST['anmelden'])  && preg_match("/([^A-Za-z])/",($_POST['Vorname'])))
{
    $fehler=false;
    echo "<span class='error'> <small> ! Sie haben eine Ungultige Name eingegeben.</small></span><br>";
}
else{
    $vorname = htmlspecialchars($_POST['Vorname']);
}

if (isset ($_POST['anmelden'])  && empty($_POST['Email']))
{
    $fehler=false;
    echo "<span class='error'> <small> ! Bitte geben Sie ihre Mail-Adresse ein.</small></span><br>";
}
elseif ((isset ($_POST['anmelden'])  && !filter_var(($_POST['Email']),FILTER_VALIDATE_EMAIL) ) || in_array($domain,$blacklist_domains))
{
    $fehler=false;
    echo "<span class='error'> <small> ! Sie haben eine ungultige Mail-Adresse eingegeben.</small></span><br>";
}
else{
    $email=htmlspecialchars($_POST['Email']);
}

if (isset ($_POST['anmelden'])  && empty($_POST['datenschutz']))
{
    $fehler=false;
    echo "<br><span style='margin: 105px; color: #ef062e;' > <small> ! Bitte stimmen Sie die Datenschutzbestimmung zu.</small></span><br>";
}

if (isset ($_POST['anmelden'])&&($fehler===true)){
    echo "<br><span style='margin: 50px; color: black; font-weight: bold'>  Danke sehr, Ihre Daten sind erfolgreich geschickt.</span><br>";
    $insert_query = "INSERT INTO emensawerbeseite.user_data (name, email) VALUES ('$vorname', '$email')";

    if (mysqli_query($link, $insert_query)) {
        echo "<span style = 'margin: 50px; color: black; font-weight: bold'> Data inserted successfully.";
    } else {
        echo "Error inserting data: " . mysqli_error($link);
    }
}
?>
