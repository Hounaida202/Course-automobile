<?php
namespace App\Models;
use App\Config\database;
use PDO;

class Course{
    private $course_id;
   private $nom;
   private $type_vehicule_autorise;
  

   public function __construct($course_id = null, $nom = null, $type_vehicule_autorise = null){
          $this->course_id=$course_id;
          $this->nom=$nom;
          $this->type_vehicule_autorise=$type_vehicule_autorise;
        
   }
public function getId(){
    return $this->course_id;
   }
   public function getNom(){
    return $this->nom;
   }
    public function getType(){
    return $this->type_vehicule_autorise;
   }
    

  public function getCourses() {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM courses";
    $stmt = $bd->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $courses = [];
    foreach ($results as $result) {
        $obj = new self($result['course_id'], $result['nom'], $result['type_vehicule_autorise']);
        $courses[] = $obj;
    }
    return $courses;
}

 public function getById($id) {
    $bd = database::getInstance()->getConnection();
    $stmt = $bd->prepare("SELECT * FROM courses WHERE course_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        // Remplir l'objet courant avec les données récupérées
        $this->course_id = $data['course_id'];
        $this->nom = $data['nom'];
        $this->type_vehicule_autorise = $data['type_vehicule_autorise'];
        return $this;  // retourner l'objet courant rempli
    }
    return null;  // si pas trouvé
}



}
?>