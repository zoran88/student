<?php

use Classes\Lib\Student as LibStudent;
use classes\Student;
use Classes\Student as ClassesStudent;

ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

if(isset($_GET['student'])){

    $studentId = $_GET['student'];

    $student = new Classes\Lib\Student($studentId);

    $student->get();
} else {
    echo '<h1>SCHOOL BOARD TEST</h1>';
}
?>