<?php
    include '../config.php';
    include '../models/Employer.php';

    if (isset($_GET['mail'])) {
        $result = Employer::delete($mysqli, $_GET['mail']);
        if ($result)
            echo "<script>
                    alert('Zaposleni sa e-mailom: ". $_GET['mail']. " je izbrisan.');
                    window.location.replace('read.php');
                    </script>";
        else
            echo "<script>window.onload = () => alert('Zaposleni sa e-mailom: ". $_GET['mail']. " ne postoji.');</script>";
    }
?>

<?php
    $title = "Obrišite zaposlenog";
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
                <h1 class="mt-4">Izbrišite zaposlenog</h1>

                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="GET">
                        <div class="form-group">
                            <label class="control-label" for="email">E-mail adresa zaposlenog</label>
                                <input id="email" name="mail" type="email" placeholder="E-mail" class="form-control input-md">
                                <span id="email_status"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger" name="remove_employer">Izbrišite</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/functions.js"></script>
</body>