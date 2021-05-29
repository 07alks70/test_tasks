<?php

$query = "SELECT u.firstName, u.lastName, c.city FROM user u INNER JOIN city c ON u.city=c.id";

?>