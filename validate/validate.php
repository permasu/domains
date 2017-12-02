<?php
/**
 * Обслуживание запросов поступающих от клиента
 * Created by PhpStorm.
 * User: Ахметшин
 * Date: 02.12.2017
 * Time: 0:27
 */
session_start();
require_once('validate.class.php');
$validator = new Validate();
//прочитать тип проверки ajax или php
$validationType = '';


if (isset($_GET['validationType'])) {
    $validationType = $_GET['validationType'];
}
if ($validationType == 'php') {

    header("Location:". $validator->ValidatePHP());

}
else {



    $response =
        '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<response>' .
        '<result>' .
        $validator->ValidateAJAX($_POST['inputValue'], $_POST['fieldID']) .
        '</result>' .
        '<fieldID>' .
        $_POST['fieldID'] .
        '</fieldID>' .
        '</response>';

//сгенерить ответ
    if (ob_get_length()) ob_clean();
    header('Content-Type: text/xml');
    echo $response;
}

?>