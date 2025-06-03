<?php
namespace App\Controllers;
use App\Models\Vehicule;
use App\Models\Course;
use App\Models\Participant;

class VehiculeController{

public function store() {
    session_start(); 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? null;
        $type = $_POST['type'] ?? null;
        $puissance = $_POST['puissance'] ?? null;
        $course_id = $_POST['course_id'] ?? null;

        $lacourse = new Course();
        $course = $lacourse->getById($course_id);

        if (!$course) {
            $_SESSION['error'] = "Course introuvable";
            header("Location: /");
            exit;
        }

        if ($type === $course->getType()) {
            // 1. Insertion du véhicule
            $vehiculeModel = new Vehicule();
            $vehiculeId = $vehiculeModel->inserer($nom, $type, $puissance);
            
            // 2. Insertion dans participants
            $participant = new Participant();
            $participant->insererParticipant($course_id, $vehiculeId); // Utilisez $vehiculeId ici

            $_SESSION['success'] = "Véhicule ajouté avec succès!";
            header("Location: /fruits/show/$course_id");
            exit;
        } else {
            $_SESSION['error'] = "Ce véhicule ne peut pas participer à cette course!";
            header("Location: /fruits/show/$course_id");
            exit;
        }
    }
}

}











?>