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
    public static function addMaj(string $text, bool $civility = false) : string
    {
        if (!$civility) {
           $tmp2 = explode(" ",$text);
           $count = count($tmp2);
            $tmp = ucfirst($tmp2[0]);
            for ($i = 1 ; $i < $count ; $i++){
                if (strpos($tmp2[$i-1],'.') || strpos($tmp2[$i-1],'!') || strpos($tmp2[$i-1],'?')){
                    $tmp2[$i] = ucfirst($tmp2[$i]);
                }
                $tmp = $tmp . " " .$tmp2[$i];
            }
            return ucfirst($tmp);
        } else {
            return str_replace(" ", "-", ucwords(str_replace("-", " ", $text)));
        }
    }

  }