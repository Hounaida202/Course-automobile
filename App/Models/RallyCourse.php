<?php
namespace App\Models;
use App\Config\database;
use App\Models\Course;
use App\Models\Vehicule;
use PDO;
class RallyCourse extends Course{


    public function classerRally($id) {
    $bd = database::getInstance()->getConnection();

    $sql = "SELECT vehicule.id, vehicule.nom, vehicule.type, vehicule.puissance 
            FROM vehicule 
            JOIN participants ON participants.vehicule_id = vehicule.id
            WHERE participants.course_id = :course_id
            AND vehicule.type = 'Rallye'";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":course_id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $rallyVehicules = [];
    foreach ($results as $result) {
        // 🎲 Ajout aléatoire à la puissance
        $bonus = rand(-10, 10); // entre -10 et +10
        $puissance_modifiee = $result['puissance'] + $bonus;

        $vehicule = new Vehicule(
            $result['id'],
            $result['nom'],
            $result['type'],
            $puissance_modifiee
        );

        $rallyVehicules[] = $vehicule;
    }

 
    return $rallyVehicules;
}



}