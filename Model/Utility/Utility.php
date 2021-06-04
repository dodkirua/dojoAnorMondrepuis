<?php


namespace Model\Utility;


class Utility{

    /**
     * function for add a array in $_SESSION
     * @param array $array
     * @param string $title
     */
    public static function addToSession(array $array, string $title = "user") : void{
        foreach ($array as $key => $data) {
            $tmp = null;
            if (is_array($data)){
                foreach ($data as $k =>$datum) {
                    $tmp[$k] = $datum;
                }
            }
            else {
                $tmp = $data;
            }
            $_SESSION[$title][$key] = $tmp;
        }
    }

    /**
     * return a string with maj after dot or after '-' for civility
     * @param string $text
     * @param bool $civility
     * @return string
     */
    public static function addMaj(string $text, bool $civility = false) : string {
        if (!$civility) {
            $tmp2 = "";
            $tmp = explode('.', $text);
            foreach ($tmp as $item) {
                $item = trim($item);
                $tmp2 = $tmp2 . ucfirst($item) . ". ";
            }
            return trim($tmp2);
        }
        else {
            return str_replace(" ", "-", ucwords(str_replace("-", " ", $text)));
        }
    }
}