<?php
namespace App\Controllers;
use App\Models\Course;
use App\Models\F1Course;
use App\Models\RallyCourse;
use App\Models\KartCourse;

class CourseController{

 public function index() {
        $courseModel = new Course ();
        $courses = $courseModel->getCourses();
        require_once __DIR__ . '/../views/fruits/index.php';
    }
    


public function get($id) {

$lacourse = new Course();
$course = $lacourse->getById($id);
// var_dump($course);
$type = $course->getType();
// var_dump($type);

$participants = [];
if ($type === 'Formule 1') {
    $f1 = new F1Course();
    $participants = $f1->classerF1($id);
}elseif ($type === 'Rallye') {
    $rally = new RallyCourse();
    $participants = $rally->classerRally($id);
} elseif ($type === 'Karting') {
    $kart = new KartCourse();
    $participants = $kart->classerKart($id);
}
// var_dump($participants);
    require_once __DIR__ . '/../views/vehicules/show.php';
}






}
?>