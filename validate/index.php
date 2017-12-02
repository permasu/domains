<?php
/**
 * Created by PhpStorm.
 * User: Ахметшин
 * Date: 0001,1.дек.2017
 * Time: 16:41
 */
require_once('index_top.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>практические примеры ajax</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="validate.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="validate.js"></script>

</head>
<body onload="setFocus()">
<fieldset>
    <legend class="txtFormLegend">new User Registration form</legend>
    <br/>
    <form name="frmRegistration" method="post" action="validate.php?validationType=php">
        <!--login-->
        <label for="txtUserName"> имя пользователя:</label>
        <input id="txtUserName" name="txtUserName" type="text" onblur="validate(this.value, this.id)"
               value="<?php echo $_SESSION['values']['txtUserName'] ?>"/>
        <span id="txtUserNameFailed"
              class="<?php echo $_SESSION['errors']['txtUserName'] ?>">
            Имя пользователя уже используется
            или поле не заполнено
        </span>
        <br/>

        <!--ИМЯ -->
        <label for="txtName">Ваше имя:</label>
        <input id="txtName" name="txtName" type="text" onblur="validate(this.value, this.id)"
               value="<?php echo $_SESSION['values']['txtName'] ?>"/>
        <span id="txtNameFailed"
              class="<?php echo $_SESSION['errors']['txtName'] ?>">
            Пожалуйса введите имя
        </span>
        <br/>


        <!--Пол-->
        <label for="selGender">Пол:</label>
        <select name="selGender" id="selGender"
                onblur="validate(this.value, this.id)">
            value="<?php buildOptions($genderOptions, $_SESSION['values']['selGender']); ?>
        </select>

        <span id="selGenderFailed"
              class="<?php echo $_SESSION['errors']['selGender'] ?>">
            Пожалуйста укажите ваш пол
    </span>
        <br/>
        <label for="selBthMonth">День рождения:</label>
        <select name="selBthMonth" id="selBthMonth"
                onblur="validate(document.getElementById('selBthMonth').selectedIndex, this.id)">
            "<?php buildOptions($monthOptions, $_SESSION['values']['selBthMonth']); ?>
        </select>
        &nbsp;-&nbsp;
        <!--День-->
        <input type="text" name="txtBthDay" id="txtBthDay" maxlength="2" size="2"
               onblur="validate(this.value, this.id)"
               value="<?php echo $_SESSION['values']['txtBthDay'] ?>"/>
        <!--Год-->
        <input type="text" name="txtBthYear" id="txtBthYear"   maxlength="4" size="2"


               onblur="validate(document.getElementById('selBthMonth').selectedIndex +
               '#'+ document.getElementById('txtBthDay').value+
               '#'+ this.value,this.id)"

               value="<?php echo $_SESSION['values']['txtBthYear'] ?>" />
<!--проверить месяц, день и год-->
        <span id="selBthMonthFailed"
              class="<?php echo $_SESSION['errors']['selBthMonth'] ?>">
            Пожалуйста, укажите месяц вашего рождения
        </span>
        <span id="txtBthDayFailed"
              class="<?php echo $_SESSION['errors']['txtBthDay'] ?>">
            Пожалуйста, укажите дату вашего рождения
        </span>
        <span id="txtBthYearFailed"
              class="<?php echo $_SESSION['errors']['txtBthYear'] ?>">
            Пожалуйста, укажите год вашего рождения
        </span>
        <br />

        <!--email -->
        <label for="txtEmail">E-mail:</label>
        <input id="txtEmail" name="txtEmail" type="text" onblur="validate(this.value, this.id)"
               value="<?php echo $_SESSION['values']['txtEmail'] ?>"/>
        <span id="txtEmailFailed"
              class="<?php echo $_SESSION['errors']['txtEmail'] ?>">
           неверный адрес электронной почты
        </span>
        <br/>


<!--конец формы-->
        <span class="txtSmall">Note: Все поля обязательны для заполнения</span>
    <br /> <br />
        <input type="submit" name="submitbutton" value="Зарегистрироваться" class="left button"/>


    </form>


</fieldset>

</body>
</html>

