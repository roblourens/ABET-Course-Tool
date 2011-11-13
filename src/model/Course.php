<?php

class Course
{
    public $designatorID = "";

    public $courseNum = "";

    // just designatorID+courseNum
    public $courseID = "";

    public $courseName = "";

    public $description = "";

    public $courseLearningOutcomes = array();

    public $syllabus = "";

    public $assignments = array();


    public function Course($_courseArray=null)
    {
        if ($_courseArray!=null)
        {
            $this->designatorID = $_courseArray['designatorID'];
            $this->courseNum = $_courseArray['courseNum'];
            $this->courseID = $_courseArray['courseID'];
            $this->courseName = $_courseArray['courseName'];
            $this->description = $_courseArray['description'];
            $this->courseLearningOutcomes = $_courseArray['courseLearningOutcomes'];
            $this->syllabus = $_courseArray['syllabus'];

            foreach ($_courseArray['assignments'] as $key=>$assignmentArray)
                $this->assignments[$key] = new Assignment($assignmentArray);
        }
    }
}

?>
