<?php

/**
 *  CreateOrder.php - класс для создания заявки
 *
 * @author Alexandr Karasev <07alks70@gmail.com>
 * @version 1.0
 */

namespace Order\CreateOrder;

class CreateOrder
{


    /**
     *
     * Открытый метод для создания заявки
     *
     * @param array $data
     * @return string
     */
    public function CreateOrder(array $data)
    {

        $time = date("Y_m_d_h-I-s");
        $feedback_name = $data['user_name'].$time.'.txt';
        $path = $_SERVER['DOCUMENT_ROOT'] . '/feedback/'. $feedback_name;

        $file_feedback = fopen($path, 'w');
        fwrite($file_feedback,'Имя пользователя: '.$data['user_name']. "\r\n");
        fwrite($file_feedback,'E-mail: '.$data['email']. "\r\n");
        fwrite($file_feedback,'Сообщение: '.$data['msg']. "\r\n");

        if (isset($data['upl_file'])) {

            $tmp_name = $data['upl_file']['tmp_name'];

            $res = $this->GetFile($data['upl_file']);

            if ($res != false) {
                fwrite($file_feedback,'Путь к файлу: '.$res. "\r\n");
            }else fwrite($file_feedback,'Путь к файлу: Ошибка загрузки файла'."\r\n");

        }

        if ($res == false) {

            fclose($file_feedback);
            unlink($path);
            return "Ваша заявка не отправлена. Файл должен иметь расширение png или jpg";

        }else {

            return "Ваша заявка отправлена";

        }

    }

    /**
     * @param $file
     * @return bool|string
     */
    private function GetFile($file)
    {

        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $allow = array('jpg', 'png');

        $name = $file['name'];
        $tmp_name = $file['tmp_name'];
        $parts = pathinfo($name);

        if (in_array($parts['extension'], $allow)) {

            move_uploaded_file($tmp_name, $path.$name);
            return $path.$name;

        }else return false;

    }

}

?>