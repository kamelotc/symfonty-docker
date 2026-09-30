<?php

namespace App\Exception\User;

class EmailAlreadyUsedException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Cette adresse email est deja utilisee.');
    }
}
