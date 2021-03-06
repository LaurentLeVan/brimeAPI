<?php

class Auth {
    public static function affirmative() {
        if(isset(getallheaders()["Authorization"])) {
            return true;
        }
        return false;
    }

    public static function content() {
        if (self::affirmative()) {
            $authorization = explode(' ', getallheaders()["Authorization"]);
            return array(
                'type' => $authorization[0],
                'data' => $authorization[1]
            );
        }
        return false;
    }

    public static function decrypt() {
        $content = self::content();
        if ($content["type"] == "Basic") {
            return base64_decode($content["data"]);
        }
    }

    public static function setResponse($code) {
        http_response_code($code);
    }
}