<?php

require_once('Homework.php');

class Course
{
    public $deptID;

    public $courseNum;

    // deptID+courseNum
    public $courseID;

    public $description;

    public $courseLearningOutcomes;

    public $syllabus;

    // Array of LOHomework objects
    public $learningOutcomeHomeworks;

    // Array of Homework objects
    public $homeworks;

    // Takes an object from the JSON representation of this course
    public function Course($_courseObj)
    {
        $this->deptID =      $_courseObj->deptID;
        $this->courseNum =   $_courseObj->courseNum;
        $this->courseID =    $_courseObj->courseID;
        $this->description = $_courseObj->description;
        $this->courseLearningOutcomes= $_courseObj->courseLearningOutcomes;
        $this->syllabus=     $_courseObj->syllabus;
        $this->learningOutcomeHomeworks = array();
        $this->homeworks = array();

        foreach($_courseObj->loHomeworks as $loHomeworkArr)
                array_push($this->learningOutcomeHomeworks, 
                    new LOHomework($loHomeworkArr));
        
        foreach($_courseObj->homeworks as $homeworkArr)
            array_push($this->homeworks, 
                new ExampleHomework($homeworkArr));
    }

    // Returns the JSON representation of this course
    function toJSON()
    {
        
    }
}


?>
