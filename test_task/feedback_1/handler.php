<?php

/**
 * Обработчик формы обратной связи
 *
 * @author Alexandr Karasev <07alks70@gmail.com>
 * @version 1.0
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require "vendor/autoload.php";

use Order\CreateOrder\CreateOrder;

$CreateOrder = new CreateOrder();

/**/


if (!empty($_POST['user-name']) && !empty($_POST['email']) && !empty($_POST['message']))
{

   $data = array(

        'user_name' => $_POST['user-name'],
        'email' => $_POST['email'],
        'msg' => $_POST['message']

    );

   if (!empty($_FILES['file_input']['name']))
    {

        $data['upl_file'] = $_FILES['file_input'];

    }


    $res = $CreateOrder->CreateOrder($data);

    echo json_encode($res);

}

?>