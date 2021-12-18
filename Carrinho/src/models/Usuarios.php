<?php

namespace src\models;

use src\helpers\Database;

class Usuarios 
{
    public function Logar($email,$senha){
        $parametro = [
            ':email' => $email,
            ':senha' => $senha
        ];   
        $index = Database::select("SELECT * FROM tb_usuario WHERE email = :email AND senha = :senha",$parametro);
              
        if (count($index) != 1) {
            return false;
        }else
            return $index;

    }
    
}
