@extends('examples.layout.basic')
@if(isset($_SESSION['login_result_message']))
    Anmeldung fehlerhaft
    <?php
        $_SESSION['login_result_message'] = NULL;
?>
@endif
@section('content')
    <form method="post" action="/anmeldung_verfizieren">
        <table>
            <thead>
            <tr>
                <th><label for="email">Ihre E-Mail:</label></th>
                <th><label for="passwort">Ihre Passwort:</label></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input required id="email" name="email" type="text" placeholder="Email"></td>
                <td><input required id="passwort" name="passwort" type="password" placeholder="Passwort"></td>
            </tr>
            </tbody>
        </table>
        <button id="submit" type="submit" name="submit" >Anmelden</button>
    </form>
@endsection

