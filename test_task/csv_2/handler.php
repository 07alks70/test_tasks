<?php

/**
 *  Обработчик для конвертации csv в таблицу
 *
 * @author Alexandr Karasev <07alks70@gmail.com>
 * @version 1.0
 */

if (!empty($_FILES['file_input'])) {

$csv = File($_FILES['file_input']['tmp_name']);

$data_table = '';

$data_table .= "<table class=\"table table-bordered table-inverse mt-5\">";

foreach ($csv as $line) {

    $data_table .= "<tr>";
    $explode_data = explode(';', $line);

    foreach ($explode_data as $item => $value)
    {

        $data_table .= "<th>$value</th>";

    }

    $data_table .= "</tr>";
}
$data_table .= "</table>";

echo json_encode($data_table);

}else json_encode('Ошибка');

?>


