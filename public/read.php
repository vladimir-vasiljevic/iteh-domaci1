<?php
    include '../config.php';
?>

<?php
    $title = "Prikaži zaposlene po poziciji";
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
                <h1 class="mt-4">Prikaži zaposlene po poziciji</h1>
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <form class="form-horizontal" method="GET">
                        <div class="form-group">
                            <label class="control-label" for="employer_position">Pozicija</label>
                            <select class="form-control" id="employer_position" onchange="search()"></select>
                        </div>
                        <br>
                    </form>
                    <div id="table"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript">
        $.get("../controllers/EmployerController.php", {data: "EmployerPosition"})
            .done(function (data) {
                var positions = JSON.parse(data);
                var output = '<option value="0">Svi zaposleni</option>';

                for (var i = 0; i < positions.length; i++) {
                    output += '<option value="' + positions[i].idPosition + '">' + positions[i].positionName + '</option>';
                }
                $('#employer_position').html(output);

                search();
            });
    </script>

    <script>
        function search() {
            $.get("../controllers/EmployerController.php", {data: "Employer"})
                .done(function (data) {
                    $('#table').html("");
                    var idPosition = $("#employer_position").val();
                    var employers = JSON.parse(data);
                    var output = '<table class="table table-hover text-left"><thead><tr class="text-left"><th>ID</th> <th>Ime</th> <th>Prezime</th> <th>E-mail</th><th>Pozicija</th></tr></thead><tbody> ';

                    for (var i = 0; i < employers.length; i++) {
                        if (idPosition == employers[i].idPosition.idPosition || idPosition == 0) {
                            output += '<tr>';
                            output += '<td>' + employers[i].idEmployer + '</td>';
                            output += '<td>' + employers[i].firstName + '</td>';
                            output += '<td>' + employers[i].lastName + '</td>';
                            output += '<td>' + employers[i].email + '</td>';
                            output += '<td>' + employers[i].idPosition.positionName + '</td>';
                            output += '</tr>';
                        }
                    }
                    output += '</tbody></table>';
                    $('#table').html(output);
                });
        }
    </script>
</body>
