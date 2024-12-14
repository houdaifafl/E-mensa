<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/emensa.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/verifizierung.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        if(!isset($_SESSION['Anmeldung ok'] )){
            $_SESSION['Anmeldung ok'] = false;
        }
        $log=FrontController::logger();
        $log->info("Zugriff auf Hauptseite");
        $data = gerichteuebersich();
        return view('examples.Pages.m4_werbeseite', ['data' => $data]);
    }
    public function debug(RequestData $request) {
        return view('debug');
    }
    public function anmelden(){
        return view('examples.Pages.anmelden');
    }
    public function abmelden(){
        $zwischen[0]= $_SESSION['name'];
        $log=FrontController::logger();
        $log->info('Abgemeldet!'  , $zwischen);
        $_SESSION['Anmeldung ok'] = false;
        $_SESSION['login_result_message']= NULL;
        $_SESSION['name'] = NULL;
        $data = gerichteuebersich();
        return view('examples.Pages.m4_werbeseite', ['data' => $data]);
    }
    public function check(RequestData $rd) {
        $email = $rd->query['email'] ?? false;
        $passwort = $rd->query['passwort'] ?? false;
        $salt = 'dbwt';
        $passwort = sha1($salt . $passwort);
        $emaildb = check_email($email);
        $passwortdb = check_pass($passwort);
        if($emaildb == NULL || $passwortdb == NULL){
            if($emaildb != NULL){
                anmeldungen_fehler($email);
            }
            $log=FrontController::logger();
            $log->warning('Anmeldung fehlgeschlagen!');
            $_SESSION['login_result_message']= 'Name oder Passwort falsch';
            header('Location: /anmeldung');
        } else {
            $_SESSION['Anmeldung ok'] = true;
            $_SESSION['login_result_message']= 'Angemeldet';
            anmeldungen($email);
            anmeldungen_erfolg($email);
            $_SESSION['name'] = get_name($email);
            $zwischen[0]= $_SESSION['name'];
            $log=FrontController::logger();
            $log->info('Angemeldet!',$zwischen);
            header('Location: /');
        }
    }
}