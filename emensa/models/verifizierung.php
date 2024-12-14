<?php
function check_email($email) {
    try {
        $link = connectdb();
        mysqli_begin_transaction($link);
        $sql = "SELECT email FROM benutzer WHERE email='$email' ";
        $result = mysqli_query($link, $sql);
        mysqli_commit($link);
        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}
function check_pass($passwort) {
    try {
        $link = connectdb();
        mysqli_begin_transaction($link);
        $sql = "SELECT passwort FROM benutzer WHERE passwort='$passwort' ";
        $result = mysqli_query($link, $sql);
        mysqli_commit($link);
        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}
function anmeldungen($email)
{
    $link = connectdb();
    $link->query("CALL anmelcount('$email')");

    mysqli_close($link);
}
function anmeldungen_erfolg($email)
{
    $link = connectdb();

    $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE email='$email'";
    mysqli_query($link, $sql);


    mysqli_close($link);
}
function anmeldungen_fehler($email)
{
    $link = connectdb();

    $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email='$email'";
    mysqli_query($link, $sql);


    mysqli_close($link);
}
function get_name($email){
    $link = connectdb();

    $sql = "SELECT name FROM benutzer WHERE email = '$email'";
    $zwischen = mysqli_query($link, $sql);
    $ergbnis = mysqli_fetch_row($zwischen);
    mysqli_close($link);
    return $ergbnis[0];
}
?>


