<?php

namespace App\Libraries;

class Authenticator
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function isAuthenticated()
    {
        return $this->session->get('user_id') !== null;
    }
}
