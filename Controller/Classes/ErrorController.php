<?php


namespace Controller\Classes;


class ErrorController extends Controller{

     /**
     * page with error
     * @param int $error
     * @return array
     */
    public static function Error(int $error) : array{
        switch ($error){
            case -1 :
                $var['error'] = "Problème lors de l'ajout";
                break;
            case -2:
                $var['error'] = "le mot de passe et le mot de passe de vérification sont différent";
                break;
            case -3:
                $var['error'] = "Le mot de passe n'est pas assez fort";
                break;
            case -4:
                $var['error'] = "Le nom d'utilisateur existe déja";
                break;
            case -5:
                $var['error'] = "Problème lors de la transmission des données au serveur";
                break;
            case -6:
                $var['error'] = "Mot de passe incorrect";
                break;
            case -7:
                $var['error'] = "Problème lors de la modification";
                break;
            default :
                exit;
        }
        return $var;
    }
}
