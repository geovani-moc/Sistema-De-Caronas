<?php

class Session{
    /*cria uma sessão, se a sessão já existe será sobrescrita se @override for true*/
    public static function create($user, $override = true){
        $isset = Session::is_set();

        if($isset && $override !== true)
            return false;

        if($isset)
            session_destroy();

        $_SESSION['user'] = $user;

        return true;
    }

    public static function destroy(){
        session_destroy();
    }

    public static function is_set(){
        return (isset($_SESSION) && isset($_SESSION['user']));
    }
};

?>