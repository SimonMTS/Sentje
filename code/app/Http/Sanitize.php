<?php

namespace App\Http;

class Sanitize
{

    public static function Input( $string ) {

        return htmlentities( $string, ENT_QUOTES );

    }

}