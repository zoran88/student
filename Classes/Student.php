<?php
namespace Classes\Lib;

class Student extends \Classes\Lib\Base\BaseStudent {
  
    protected $studentId;

    private $render;

    function __construct($studentId) 
    {
        parent::__construct($studentId);

        if($this->school->getDataType() == 'json'){
            $this->render = new \Classes\Lib\RenderJson;
        } else {
            $this->render = new \Classes\Lib\RenderXml;
        }
    }

    /**
     * get student information
     *
     * @return void
     */
    public function get()
    {
        $this->average = $this->getAverage();
        $this->status = $this->getStatus();

        return $this->render->render($this);
    }

    /**
     * get average grade
     *
     * @param array $grades
     * @return decimal
     */
    private function getAverage()
    {
        $sum = 0;
        foreach($this->grades as $grade){
            $sum += $grade['grade'];
        }

        $average = round($sum / count($this->grades), 2);
        return $average;
    }

    /**
     * get student status
     *
     * @param array $grades
     * @param string $schoolName
     * @return string
     */
    private function getStatus()
    {
        if($this->school->getName() == 'CSM'){
            $average = $this->getAverage($this->grades);
            if($average >= 7){
                $status = 'pass';
            } else {
                $status = 'fail';
            }
        } elseif($this->school->getName() == 'CSMB') {
            $highestGrade = $this->grades[0]['grade'];
            $lowestGradeKey = 0;
            $lowestGrade = $this->grades[0]['grade'];
            for($i = 1; $i < count($this->grades); $i++){
                if($highestGrade < $this->grades[$i]['grade']){
                    $highestGrade = $this->grades[$i]['grade'];
                }

                if($lowestGrade > $this->grades[$i]['grade']){
                    $lowestGrade = $this->grades[$i]['grade'];
                    $lowestGradeKey = $i;
                }
            }

            if(count($this->grades) > 2){
                unset($this->grades[$lowestGradeKey]);
            }

            if($highestGrade > 8){
                $status = 'pass';
            } else {
                $status = 'fail';
            }
        }

        return $status;
    }
}
