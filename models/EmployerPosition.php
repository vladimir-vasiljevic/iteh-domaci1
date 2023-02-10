<?php


class EmployerPosition
{
    public $idPosition = 0;
    public $positionName = '';
    public $positionFullName = '';

    public static function returnAll($mysqli)
    {
        $result = $mysqli->query("SELECT * FROM employer_position");
        $positions = array();

        while ($row = $result->fetch_assoc()) {
            $position = new EmployerPosition();
            $position->idPosition = $row['idPosition'];
            $position->positionName = $row['positionName'];
            $position->positionFullName = $row['positionFullName'];
            array_push($positions, $position);
        }

        return $positions;
    }
}