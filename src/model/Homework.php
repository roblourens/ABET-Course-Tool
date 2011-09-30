<?php

class LOHomework
{
    public $type;

    public $number;

    public $learningOutcomes;

    public function LOHomework($_rawCourseArr)
    {
        $this->type =             $_rawCourseArr->type;
        $this->number =           $_rawCourseArr->number;
        $this->learningOutcomes = $_rawCourseArr->outcomes;
    }
}

class ExampleHomework
{
    public $name;

    public $type;

    // url-encoded name?
    public $assignmentName;

    // random number, or uploaded file name
    public $exampleNames;

    // Takes an array from the JSON representation of this course
    public function ExampleHomework($_rawCourseArr)
    {
        $this->name =     $_rawCourseArr->name;
        $this->type =     $_rawCourseArr->type;
        $this->assignmentName =   $_rawCourseArr->assignmentName;
        $this->exampleNames =     $_rawCourseArr->exampleNames;
    }

    // Returns the JSON representation of this course
    public function toJSON()
    {
        
    }
}


?>
