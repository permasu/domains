<?php
/**
 * класс реализующий фукнции проверки Validate()
 * Created by PhpStorm.
 * User: Ахметшин
 * Date: 02.12.2017
 * Time: 0:29
 */

require_once('config.php');

class Validate
{
    private $mMysqli;

    function __construct()
    {
        $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    }

    function __destruct()
    {
        $this->mMysqli->close();

    }
//поддержка проверки правильности типа AJAX
//проверяет единственное значение
    public function ValidateAJAX($inputValue, $fieldID)
    {

         switch ($fieldID) {
            case 'txtUserName':
                return $this->ValidateUserName($inputValue);
                break;
            case 'txtName':
                return $this->ValidateName($inputValue);
                break;
            case 'selGender':
                return $this->ValidateGender($inputValue);
                break;
            case 'selBthMonth':
                return $this->ValidateBirthMonth($inputValue);
                break;
            case 'txtBthDay':
                return $this->ValidateBirthDay($inputValue);
                break;
            case 'txtBthYear':
                return $this->ValidateBirthYear($inputValue);
                break;
            case 'txtEmail':
                return $this->ValidateEmail($inputValue);
                break;
            case 'txtUserNAme':
                return $this->ValidateUserName($inputValue);
                break;

        }
    }

//проверяет правильность заполнения всех полей формы

    /**
     * @return string
     */
    public function ValidatePHP()
    {
        $errorExist = 0;
        if (isset($_SESSION['errors']))
            unset($_SESSION['errors']);
        //по умолчанию все поля считаются правильными
        $_SESSION['errors']['txtUsername'] = 'hidden';
        $_SESSION['errors']['txtName'] = 'hidden';
        $_SESSION['errors']['selGender'] = 'hidden';
        $_SESSION['errors']['selBthMonth'] = 'hidden';
        $_SESSION['errors']['txtBthDay'] = 'hidden';
        $_SESSION['errors']['txtBthYear'] = 'hidden';
        $_SESSION['errors']['txtEmail'] = 'hidden';
        $_SESSION['errors']['txtPhone'] = 'hidden';
        $_SESSION['errors']['chkReadTerms'] = 'hidden';
        if (!$this->ValidateUserName($_POST['txtUserName'])) {
            $_SESSION['errors']['txtUserName'] = 'error';
            $errorExist = 1;
        }
        if (!$this->ValidateName($_POST['txtName'])) {
            $_SESSION['errors']['txtName'] = 'error';
            $errorExist = 1;
        }
        if (!$this->ValidateGender($_POST['selGender'])) {
            $_SESSION['errors']['selGender'] = 'error';
            $errorExist = 1;
        }
        if (!$this->validateBirthMonth(preg_replace("/[^0-9]/", '',$_POST['selBthMonth'])))
        {
            $_SESSION['errors']['selBthMonth'] = 'error';
            $errorExist = 1;

        }

        if (!$this->ValidateBirthDay($_POST['txtBthDay'])) {
            $_SESSION['errors']['txtBthDay'] = 'error';
            $errorExist = 1;
        }
        if (!$this->ValidateBirthYear($_POST['txtBthMonth'] . '#' .
            $_POST['txtBthDay'] . '#' .
            $_POST['txtBthYear']))
        {
//            $_SESSION['errors']['txtBthYear'] = 'error';
//            $errorExist = 1;
        }
        if (!$this->ValidateEmail($_POST['txtEmail'])) {
            $_SESSION['errors']['txtEmail'] = 'error';
            $errorExist = 1;
        }
        if ($errorExist == 0) {
            return 'allok.php';
        } else {
            foreach ($_POST as $key => $value) {
                $_SESSION['values'][$key] = $_POST[$key];
            }
            return 'index.php';
        }
    }


    private function ValidateUserName($value)
    {
        $value = $this->mMysqli->real_escape_string(trim($value));
        if ($value == null)
            return 0;

        $queryText='Select name from wa_country ' .
            'where name="' . $value . '"';
        $query = $this->mMysqli->query($queryText);
        if ($this->mMysqli->affected_rows > 0)
            return '0';
        else
            return '1';

    }

    private function ValidateName($value)
    {
        $value = trim($value);
        if ($value)
            return 1;
        else
            return 0;
    }

    private function validateGender($value)
    {
        return ($value == '0') ? 0 : 1;
    }

    private function validateBirthMonth($value)
    {
        $otvet  =   ($value == '' || $value > 12 || $value < 1) ? 0 : 1;
        return  $otvet;
    }

    private function validateBirthDay($value)
    {
        return ($value == '' || $value > 31 || $value < 1) ? 0 : 1;
    }

    private function validateBirthYear($value)
    {
      $date =   explode('#',$value);
      if (!$date[0]) return 0;
      if (!$date[1] || !is_numeric($date[1])) return 0;
      if (!$date[2] || !is_numeric($date[2])) return 0;
      $check= checkdate($date[0],$date[1],$date[2]);
      return ($check) ? 1: 0;
    }

private function validateEmail($value)
{
    //корректный формат адресом: *@*.*,*@*.*.*,*.*@*.*,*.*@*.*.*
    return (filter_var($value,FILTER_VALIDATE_EMAIL))? 1:0;


}
}

