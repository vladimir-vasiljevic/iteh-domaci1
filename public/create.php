<?php
    include '../config.php';
    include '../models/Employer.php';

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['employer_position'])){
        $user = new Employer();

        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = strtolower($_POST['email']);
        $idPosition = $_POST['employer_position'];

        $user->checkEmail($mysqli, $firstName, $lastName, $email, $idPosition);
    }
?>

<?php
    $title = "Unesite novog zaposlenog";
    include("parts/header.php");
?>

<body>
    <div class="d-flex" id="wrapper">
        <?php include("parts/sidebar.php") ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Meni</button>
            </nav>
            <!-- /#page-content-wrapper -->
            <div class="container-fluid">
                <h1 class="mt-4">Unesite novog zaposlenog</h1>

                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="first_name">Ime</label>
                            <input id="first_name" name="first_name" type="text" placeholder="Ime" class="form-control input-md">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="last_name">Prezime</label>
                            <input id="last_name" name="last_name" type="text" placeholder="Prezime" class="form-control input-md">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">E-mail</label>
                            <input id="email" name="email" type="email" placeholder="E-mail" class="form-control input-md">
                            <span id="email_status"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="employer_position">Pozicija</label>
                            <select class="form-control" name="employer_position" id="employer_position"></select>
                        </div>

                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="validateForm()">Dodajte novog zaposlenog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript">
        $.get("../controllers/EmployerController.php", {data: "EmployerPosition"})
            .done(function (data) {
                var positions = JSON.parse(data);
                var output = '<option value="0">Pozicije</option>';

                for (var i = 0; i < positions.length; i++) {
                    output += '<option value="' + positions[i].idPosition + '">' + positions[i].positionName + '</option>';
                }

                $('#employer_position').html(output);
            });
    </script>
</body>
