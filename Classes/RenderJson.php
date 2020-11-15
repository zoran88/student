<?php
namespace Classes\Lib;

class RenderJson implements RenderInterface {

    public function render($object)
    {
        $json['student_id'] = $object->getSid();
        $json['student_name'] = $object->getName();

        $studentGrades = '';
        foreach($object->grades as $key => $grade){
            if(count($object->grades) - 1  == $key){
                $studentGrades .= $grade['grade'];
            } else {
                $studentGrades .= $grade['grade'] . ',';
            }
        }

        $json['grades'] = $studentGrades;
        $json['average'] = $object->average;
        $json['status'] = $object->status;

        echo json_encode($json);
    }

}