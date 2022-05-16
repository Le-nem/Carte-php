<?php

class Connect {

    public static function Pdo() {
         return new PDO('mysql:host=localhost;dbname=high_society','root','');
    }
}