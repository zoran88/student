<?php
namespace Classes\Lib;

use SimpleXMLElement;

class RenderXml implements RenderInterface {

    public function render($object){
        $xml = new SimpleXMLElement('<xml/>');
        $studentXml = $xml->addChild('student');
        $studentXml->addChild('student_id', $object->getSid());
        $studentXml->addChild('student_name', $object->getName());

        $studentGrades = '';
        foreach($object->grades as $key => $grade){
            if(count($object->grades) - 1  == $key){
                $studentGrades .= $grade['grade'];
            } else {
                $studentGrades .= $grade['grade'] . ',';
            }
        }

        $studentXml->addChild('grades', $studentGrades);
        $studentXml->addChild('average', $object->average);
        $studentXml->addChild('status', $object->status);

        Header('Content-type: text/xml');
        print($studentXml->asXML());
    }


}