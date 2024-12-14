<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => "HomeController@index",
    '/anmeldung'     => "HomeController@anmelden",
    '/abmeldung'     => "HomeController@abmelden",
    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'   => 'DemoController@requestdata',
    '/kategorie'     => 'ExampleController@m4_7b_kategorie',
    '/gerichte'      => 'ExampleController@m4_7c_gerichte',
    '/layouts'       => 'ExampleController@layyout',
    '/anmeldung_verfizieren' => 'HomeController@check',
    // Erstes Beispiel:
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4' => 'ExampleController@m4_7a_queryparameter',

);