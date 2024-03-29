<?php
    include '../config.php';
    include '../models/Employer.php';

    if (isset($_GET['email'])) {
        $employer = Employer::readOne($mysqli, $_GET['email']);
    }

    if (isset($_POST['edit_employer'])) {
        if (Employer::update($mysqli, $_POST['id'], $_POST['first_name'], $_POST['last_name'], strtolower($_POST['mail']), $_POST['employer_position'])) {
            echo "<script>
                    alert('Informacije o zaposlenom uspešno ažurirane.);
                    window.location.replace('read.php');
                    </script>";
        } else {
            echo "<script> alert('Greška.');</script>";
        }
    }
?>

<?php
    $title = "Uredite informacije o zaposlenom";
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
                <h1 class="mt-4">Uredite informacije o zaposlenom</h1>

                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="GET">
                        <div class="form-group">
                            <label class="control-label" for="email">E-mail adresa zaposlenog</label>
                            <input id="email" name="email" type="email" placeholder="E-mail" class="form-control input-md">
                            <span id="email_status"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" name="find_employer">Pronađi</button>
                        </div>
                    </form>

                    <form class="form-horizontal" method="POST" style="margin-top: 100px;">
                        <div class="form-group">
                            <label class="control-label" for="id">ID</label>
                            <input id="id" name="id" type="text" placeholder="ID" class="form-control input-md"
                                   value="<?php if(isset($employer[0]->idEmployer)) echo($employer[0]->idEmployer); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="first_name">Ime</label>
                            <input id="first_name" name="first_name" type="text" placeholder="Ime" class="form-control input-md"
                                   value="<?php if(isset($employer[0]->firstName)) echo $employer[0]->firstName; ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="last_name">Prezime</label>
                            <input id="last_name" name="last_name" type="text" placeholder="Prezime" class="form-control input-md"
                                   value="<?php if(isset( $employer[0]->lastName)) echo $employer[0]->lastName; ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="mail">E-mail</label>
                            <input id="email" name="mail" type="email" placeholder="E-mail" class="form-control input-md"
                                   value="<?php if(isset($employer[0]->email)) echo $employer[0]->email; ?>">
                            <span id="email_status"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="employer_position">Pozicija</label>
                            <select class="form-control" name="employer_position" id="employer_position"></select>
                        </div>

                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning" name="edit_employer">Izmeni</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript">
        $.get("../controllers/EmployerController.php", {data: "EmployerPosition"})
            .done(function (data) {
                var positions = JSON.parse(data);
                var output = '';

                for (var i = 0; i < positions.length; i++) {
                    if (positions[i].idPosition == '<?php if(isset($employer[0]->idPosition)) echo $employer[0]->idPosition; else echo "0"; ?>')
                        output += '<option value="' + positions[i].idPosition + '" selected >' + positions[i].positionName +'</option>';
                    else
                        output += '<option value="' + positions[i].idPosition + '">' + positions[i].positionName +'</option>';

                }

                $('#employer_position').html(output);
            });
    </script>
</body>

