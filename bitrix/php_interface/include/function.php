<?
/**
 * Created by PhpStorm.
 * User: Asus-
 * Date: 04.01.2015
 * Time: 3:31
 */
function test_dump($arg){
    global $USER;
    if($USER->IsAdmin()){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }

}