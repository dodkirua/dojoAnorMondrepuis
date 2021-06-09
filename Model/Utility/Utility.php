<?php


namespace Model\Utility;


class Utility{

    /**
     * function for add a array in $_SESSION
     * @param array $array
     * @param string|null $title
     */
    public static function addToSession(array $array, string $title = null) : void{
        if (is_null($title)){
            $tmpArray = &$_SESSION;
        }
        else {
            $tmpArray = &$_SESSION[$title];
        }
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
            $tmpArray[$key] = $tmp;
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
            return str_replace(" ","-", ucwords(str_replace("-"," ", $text)));
        }
    }

    /**
     * remove 0 in start
     * @param string $text$param['surname']
     * @return string
     */
    public static function removeZero(string $text) : string {
        if (substr($text,0,1) === "0"){
            return substr($text,1);
        }
        else {
            return $text;
        }
    }

    /**
     * create username by name an surname
     * @param string $name
     * @param string $surname
     * @return string
     */
    public static function createUsername(string $name, string $surname) :string {
        $nameExplode = explode('-',$name);
        foreach ($nameExplode as $n){
            $initial = $initial . substr($n, 0, 1);
        }
        return $initial . $surname;

    }
    
    public static function createPassword() : string{
        $min = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
        $maj = ["A","Z","E","R","T","Y","U","I","O","P","Q","S","D","F","G","H","J","K","L","M","W","X","C","V","B","N"];
        $number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $spe = ["(", "-", ")", "@", ];
        $m = $min[array_rand($min)];
        $M = $maj[array_rand($maj)];
        $num = $number[array_rand($number)];
        $s = $spe[array_rand($spe)];
        $password = $m . $M . $num . $s ;
        $characters = array_merge($number,$maj,$min,$spe);
        shuffle($characters);
        for($i=0 ; $i < 10; $i++) {
            $password .= $characters[array_rand($characters)];
        }

        return str_shuffle($password);
      
    }
  }