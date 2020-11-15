<?php
namespace Classes\Lib\Base;

class BaseGrade extends \Classes\Lib\Database {

    // protected $sbid;

    // protected $name;

    // protected $dataType;

    function __construct()
    {
        parent::__construct();
        // $this->init($schoolId);
    }

    // private function init($schoolId)
    // {
    //     $this->doSelectGrades($schoolId);
    // }

    // protected function setSbid($sbid)
    // {
    //     if(!is_numeric($sbid)){
    //         return;
    //     }
    //     $this->sbid = $sbid;
    // }

    // protected function getSbid()
    // {
    //     return $this->sbid;
    // }

    // protected function setName($name)
    // {
    //     $this->name = $name;
    // }

    // protected function getName()
    // {
    //     return $this->name;
    // }

    // protected function setDataType($datatype)
    // {
    //     $this->datatype = $datatype;
    // }

    // protected function getDataType()
    // {
    //     return $this->sbid;
    // }

    /**
     * returns student 
     *
     * @param int
     * @return array
     */
    public function doSelectGrades($id)
    {
        $query = 'SELECT grade from grades WHERE sid = ' .$id;
        $result = mysqli_query($this->connection, $query);

        $response = [];
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $response[] = $row;
            }
        }
        return $response;
    }
}
