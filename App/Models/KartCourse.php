<?php
namespace App\Models;
use App\Config\database;
use App\Models\Course;
use App\Models\Vehicule;
use PDO;
class KartCourse extends Course{


    public function classerKart($id) {
    $bd = database::getInstance()->getConnection();

    $sql = "SELECT vehicule.id, vehicule.nom, vehicule.type, vehicule.puissance 
            FROM vehicule 
            JOIN participants ON participants.vehicule_id = vehicule.id
            WHERE participants.course_id = :course_id
            AND vehicule.type = 'Karting'";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":course_id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $kartVehicules = [];
    foreach ($results as $result) {
        $puissance_modifiee = ($result['puissance'] > 150)
            ? $result['puissance'] - 20
            : $result['puissance'];

        $vehicule = new Vehicule(
            $result['id'],
            $result['nom'],
            $result['type'],
            $puissance_modifiee
        );

        $kartVehicules[] = $vehicule;
    }
    return $kartVehicules;
}



}