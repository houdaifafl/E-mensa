<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
class ExampleController
{
    public function m4_7a_queryparameter(RequestData $rd) {

        return view('examples.m4_7a_queryparameter', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7b_kategorie(){
        $data = db_kategorie_select_all();
        return view('examples.m4_7b_kategorie', ['data' => $data]);
    }
    public function m4_7c_gerichte(){
        $data = db_gericht_select_all();
        return view('examples.m4_7c_gerichte', ['data' => $data]);
    }
    public function layyout(){
        $page=$_GET['no'] ?? 1;
        if($page==1){
            return view('examples.pages.m4_7d_page_1');
        }

        else if ($page==2){
            return view('examples.pages.m4_7d_page_2');

        }
    }
}