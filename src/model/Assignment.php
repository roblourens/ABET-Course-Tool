<?php

class Assignment
{
    public $number = "";

    public $type = "";

    public $learningOutcomes = array();

    public function Assignment($_assignArray=null)
    {
        if ($_assignArray != null)
        {
            $this->number = $_assignArray['number'];
            $this->type = $_assignArray['type'];
            $this->learningOutcomes = $_assignArray['learningOutcomes'];
        }
    }
}

class SampleAssignment
{
    public $number = "";

    public $type = "";

    public $assignmentFileName = "";

    public $sampleFileNames = array("", "", "");

    public function Assignment($_assignArray=null)
    {
        if ($_assignArray != null)
        {
            $this->number = $_assignArray['number'];
            $this->type = $_assignArray['type'];
            $this->assignmentFileName = $_assignArray['assignmentFileName'];
            $this->sampleFileNames = $_assignArray['sampleFileNames'];
        }
    }
}

?>
