<?php

namespace Model;

class Home extends \CodeLighter\Controller
{
    function __construct()
    {
        $this->DB = new \Helper\Database();
    }
    function CSRF()
    {
        return clean($_COOKIE['CSRF'] ?? 0);
    }
    function isLogin()
    {
        return $this->DB->check('SELECT id FROM sessions WHERE token = "' . $this->CSRF() . '"');
    }
    function test()
    {
        $p = $this->check([
            'username' => 'Unesite korisničko ime!',
        ]);
        if (count($p->_errors)) return [$p->_errors[0], $p->_fields[0]];
        return $p->username;
        return ["success" => "Uspešno!"];
    }
}
