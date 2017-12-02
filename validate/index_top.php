<?php
/**
 * Created by PhpStorm.
 * User: Ахметшин
 * Date: 0001,1.дек.2017
 * Time: 16:03
 */
session_start();
//создать тэги HTML<option>
function buildOptions($options, $selectedOption)
{
    foreach ($options as $value => $text) {
        if ($value == $selectedOption) {
            echo '<option value="' . $value . '" selected="selected">' . $text . '</option>';

        } else
            echo '<option value="' . $value . '">' . $text . '</option>';

    }
}
$genderOptions=array(
        "0"=>"[Выбрать]",
        "1"=>"Муж.",
        "2"=>"Жен.");
$monthOptions   =   array(
    "[0]"=> "[Выбрать]",
    "[1]"=> "Январь",
    "[2]"=> "Февраль",
    "[3]"=> "Март",
    "[4]"=> "Апрель",
    "[5]"=> "Май",
    "[6]"=> "Июнь",
    "[7]"=> "Июль",
    "[8]"=> "Август",
    "[9]"=> "Сентябрь",
    "[10]"=>"Октябрь",
    "[11]"=>"Ноябрь",
    "[12]"=>"Декабрь");
if (!isset($_SESSION['values']))
{
    $_SESSION['values']['txtUsername']='';
    $_SESSION['values']['txtName']='';
    $_SESSION['values']['selGender']='';
    $_SESSION['values']['selBthMonth']='';
    $_SESSION['values']['txtBthDay']='';
    $_SESSION['values']['txtBthYear']='';
    $_SESSION['values']['txtEmail']='';
    $_SESSION['values']['txtPhone']='';
    $_SESSION['values']['chkReadTerms']='';
}

if (!isset($_SESSION['errors']))
{
    $_SESSION['errors']['txtUsername']  ='hidden';
    $_SESSION['errors']['txtName']      ='hidden';
    $_SESSION['errors']['selGender']    ='hidden';
    $_SESSION['errors']['selBthMonth']  ='hidden';
    $_SESSION['errors']['txtBthDay']    ='hidden';
    $_SESSION['errors']['txtBthYear']   ='hidden';
    $_SESSION['errors']['txtEmail']     ='hidden';
    $_SESSION['errors']['txtPhone']     ='hidden';
    $_SESSION['errors']['chkReadTerms'] ='hidden';
}
//дописан