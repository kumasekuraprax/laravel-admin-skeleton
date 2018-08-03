<?php

namespace App\Http\Traits;

trait ValidatorTrait
{
    public function validarEmail($email)
    {
        $nome_email = "/^[a-zA-Z0-9\._-]+@";
        $dominio    = "[a-zA-Z0-9\._-]+.";
        $extensao   = "([a-zA-Z]{2,4})$/";

        // monta a Pattern
        $pattern = $nome_email . $dominio . $extensao;

        // Compara o E-mail com o Pattern
        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }
}
