<?php
    include '../config.php';
    include '../models/Employer.php';
    include '../models/EmployerPosition.php';

    if (isset($_GET['data']) && $_GET['data'] == 'EmployerPosition') {
        echo json_encode(EmployerPosition::returnAll($mysqli));
    }

    if(isset($_GET['data']) && $_GET['data']=='Employer') {
        echo json_encode(Employer::readAll($mysqli));
    }




