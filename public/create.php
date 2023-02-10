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
    $title = "Insert New Employer";
    include("parts/header.php");
?>

<body>
    <div class="d-flex" id="wrapper">
        <?php include("parts/sidebar.php") ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Dashboard</button>
            </nav>
            <!-- /#page-content-wrapper -->
            <div class="container-fluid">
                <h1 class="mt-4">Insert New Employer</h1>

                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="first_name">First Name</label>
                            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control input-md">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="last_name">Last Name</label>
                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control input-md">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">E-mail</label>
                            <input id="email" name="email" type="email" placeholder="E-mail" class="form-control input-md">
                            <span id="email_status"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="employer_position">Employer Position</label>
                            <select class="form-control" name="employer_position" id="employer_position"></select>
                        </div>

                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="validateForm()">Add New Employer</button>
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
                var output = '<option value="0">Positions</option>';

                for (var i = 0; i < positions.length; i++) {
                    output += '<option value="' + positions[i].idPosition + '">' + positions[i].positionName + '</option>';
                }

                $('#employer_position').html(output);
            });
    </script>
</body>
