<?php
namespace Classes\Lib\Base;

class BaseStudent extends \Classes\Lib\Database {

    private $sid;

    private $name;

    private $sbid;

    protected $school;

    function __construct(Int $studentId)
    {
        parent::__construct();
        $this->init($studentId);
    }

    private function init($studentId)
    {
        $this->doSelectStudent($studentId);
    }

    private function setSid($sid)
    {
        if(!is_numeric($sid)){
            return;
        }
        $this->sid = $sid;
    }

    public function getSid()
    {
        return $this->sid;
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    private function setSbid($sbid)
    {
        if(!is_numeric($sbid)){
            return;
        }
        $this->sbid = $sbid;
    }

    public function getSbid()
    {
        return $this->sbid;
    }

    /**
     * returns student 
     *
     * @param int
     * @return array
     */
    public function doSelectStudent($id)
    {
        //$query = 'SELECT s.sid, s.name, sb.data_type, sb.name as school_name from student as s JOIN school_board as sb ON s.sbid = sb.sbid WHERE s.sid = ' .$id;
        $query = 'SELECT * from student WHERE `sid` = ' .$id;
        $result = mysqli_query($this->connection, $query);

        $row = false;
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
        }

        if($row){
            $this->setSid($row['sid']);
            $this->setName($row['name']);
            $this->setSbid($row['sbid']);
        }

        $school = new \Classes\Lib\Base\BaseSchool($this->getSbid());
        $this->school = $school;

        $grades = new \Classes\Lib\Base\BaseGrade();
        $this->grades = $grades->doSelectGrades($id);
    }
}
