<?php
namespace App\Models;
use App\Config\database;
use App\Models\Course;
use App\Models\Vehicule;
use PDO;
class F1Course extends Course{


 public function classerF1($id){
    $bd = database::getInstance()->getConnection();

    $sql = "SELECT vehicule.id, vehicule.nom, vehicule.type, vehicule.puissance 
            FROM vehicule 
            JOIN participants ON participants.vehicule_id = vehicule.id
            JOIN courses ON courses.course_id = participants.course_id
            WHERE courses.course_id = :course_id
            AND vehicule.type = 'F1'
            ORDER BY vehicule.puissance DESC";

    $stmt = $bd->prepare($sql);

    // Cast $id en int au cas où
    $courseId = (int)$id;

    $stmt->bindParam(":course_id", $courseId, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($results);  // <<-- Regarde ce que ça donne

    // Retourne les objets comme avant si tu veux
    $f1courses = [];
    foreach ($results as $result) {
        $vehicule = new Vehicule(
            $result['id'],
            $result['nom'],
            $result['type'],
            $result['puissance']
        );
        $f1courses[] = $vehicule;
    }
    return $f1courses;
}






}