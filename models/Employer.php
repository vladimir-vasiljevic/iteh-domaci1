<?php


class Employer 
{
    public $idEmployer = 0;
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $idPosition = 0;

    public static function create($mysqli, $firstName, $lastName, $email, $idPosition)
    {
        $result = $mysqli->query("INSERT INTO employer (firstName, lastName, email, idPosition) VALUES ('$firstName', '$lastName', '$email', '$idPosition')");

        if ($result > 0)
            return true;
        else
            return false;
    }

    public static function readOne($mysqli, $email)
    {
        $result = $mysqli->query("SELECT * FROM employer e JOIN employer_position ep ON e.idPosition = ep.idPosition WHERE email='" . $email . "'");
        return self::getEmployer($result);
    }

    public static function readAll($mysqli)
    {
        $result = $mysqli->query("SELECT * FROM employer e JOIN employer_position ep ON e.idPosition = ep.idPosition order by e.idEmployer");
        $employers = array();
        while ($row = $result->fetch_assoc()) {
            $employerPosition = new EmployerPosition();
            $employerPosition->idPosition = $row['idPosition'];
            $employerPosition->positionName = $row['positionName'];
            $employerPosition->positionFullName = $row['positionFullName'];

            $Employer = new Employer();
            $Employer->idEmployer = $row['idEmployer'];
            $Employer->firstName = $row['firstName'];
            $Employer->lastName = $row['lastName'];
            $Employer->email = $row['email'];
            $Employer->idPosition = $employerPosition;

            array_push($employers, $Employer);
        }
        return $employers;
    }

    public static function update($mysqli, $idEmployer, $firstName, $lastName, $email, $idPosition)
    {
        $mysqli->query("UPDATE employer SET firstName = '$firstName', lastName='$lastName', email = '$email', idPosition='$idPosition' WHERE idEmployer='$idEmployer'");

        $result = $mysqli->affected_rows;

        if ($result > 0)
            return true;
        else
            return false;
    }

    public static function delete($mysqli, $email)
    {
        $mysqli->query("DELETE FROM employer WHERE email='$email'");
        $result = $mysqli->affected_rows;

        if ($result > 0)
            return true;
        else
            return false;
    }

    public function checkEmail($mysqli, $firstName, $lastName, $email, $idPosition)
    {
        $result = $mysqli->query("SELECT * FROM employer WHERE email='$email '");
        $employers = $this->getEmployer($result);
        if (count($employers) > 0) {
            echo "<script>alert('Zaposleni sa ovo email adresom već postoji. Molimo pokušajte ponovo.);</script>";
            return false;
        } else {
            $this->create($mysqli, $firstName, $lastName, $email, $idPosition);
            echo "<script>alert('Employee successfully added');</script>";
            return true;
        }
    }

    private function getEmployer($result)
    {
        $employers = array();
        while ($row = $result->fetch_assoc()) {
            $employer = new Employer();
            $employer->idEmployer = $row['idEmployer'];
            $employer->firstName = $row['firstName'];
            $employer->lastName = $row['lastName'];
            $employer->email = $row['email'];
            $employer->idPosition = $row['idPosition'];

            array_push($employers, $employer);
        }
        return $employers;
    }
}