<?php


namespace Model\Utility;


class Security{

    /**
     * Method that returns a healthy character string for the database
     * @param $data
     * @return String
     */
    public static function sanitize($data) : String {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return addslashes($data);
    }

    /**
     * verify pattern's password and return the string if is ok
     * @param string $pass
     * @return string|null
     */
    public static function checkPass(string $pass) : ?string {
        $maj = preg_match('@[A-Z]@', $pass);
        $min = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        $char = preg_match('@[^a-zA-Z\d]@', $pass);

        if(!$maj|| !$min || !$number || !$char || strlen($pass) < 10)    {
            return null;
        }
        else{
            return $pass;
        }
    }
}