<?php
namespace App\Models;
use App\Config\database;
use PDO;

class Participant{
    private $id;
   private $course_id;
   private $vehicule_id;
  

   public function __construct($id = null, $course_id = null, $vehicule_id = null){
       $this->id=$id;
          $this->course_id=$course_id;
          $this->vehicule_id=$vehicule_id;
        
   }
   public function getId(){
    return $this->id;
   }
public function getCourseId(){
    return $this->course_id;
   }
    public function getVehiculeId(){
    return $this->vehicule_id;
   }
    

 public function insererParticipant($course_id,$vehicule_id){
        $db = database::getInstance()->getConnection();
 $sql = "INSERT INTO participants (course_id,vehicule_id) 
        VALUES (:course_id, :vehicule_id)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':course_id',$course_id);
$stmt->bindParam(':vehicule_id',$vehicule_id);
 $stmt->execute();
        return $db->lastInsertId();
}



}
?>