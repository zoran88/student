<?php
namespace Classes\Lib\Base;

class BaseSchool extends \Classes\Lib\Database {

    public $sbid;

    public $name;

    public $dataType;

    function __construct(Int $schoolId)
    {
        parent::__construct();
        $this->init($schoolId);
    }

    public function init($schoolId)
    {
        $this->doSelectSchool($schoolId);
    }

    public function setSbid($sbid)
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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDataType($datatype)
    {
        $this->datatype = $datatype;
    }

    public function getDataType()
    {
        return $this->datatype;
    }

    /**
     * returns student 
     *
     * @param int
     * @return array
     */
    public function doSelectSchool($id)
    {
        //$query = 'SELECT s.sid, s.name, sb.data_type, sb.name as school_name from student as s JOIN school_board as sb ON s.sbid = sb.sbid WHERE s.sid = ' .$id;
        $query = 'SELECT * from school_board WHERE `sbid` = ' .$id;
        $result = mysqli_query($this->connection, $query);

        $row = array();
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
        }

        if($row){
            $this->setSbid($row['sbid']);
            $this->setName($row['name']);
            $this->setDataType($row['data_type']);
        }
    }
}
