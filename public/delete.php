<?php
    include '../config.php';
    include '../models/Employer.php';

    if (isset($_GET['mail'])) {
        $result = Employer::delete($mysqli, $_GET['mail']);
        if ($result)
            echo "<script>
                    alert('Employee with e-mail: ". $_GET['mail']. " removed.');
                    window.location.replace('read.php');
                    </script>";
        else
            echo "<script>window.onload = () => alert('User with e-mail: ". $_GET['mail']. " does not exist.');</script>";
    }
?>

<?php
    $title = "Obrisati zaposlenog";
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
                <h1 class="mt-4">Remove Employer</h1>

                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="GET">
                        <div class="form-group">
                            <label class="control-label" for="email">Employer's e-mail</label>
                                <input id="email" name="mail" type="email" placeholder="E-mail" class="form-control input-md">
                                <span id="email_status"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger" name="remove_employer">Remove Employer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/functions.js"></script>
</body>