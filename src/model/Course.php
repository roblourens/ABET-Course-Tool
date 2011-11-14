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

    // Returns true if each outcome is an outcomes for at least one assignment
    public function matchesOutcomes($searchOutcomes)
    {
        $courseOutcomes = $this->allOutcomes();
        foreach ($searchOutcomes as $outcome)
            if (!in_array($outcome, $courseOutcomes))
                return false;

        return true;
    }

    public function allOutcomes()
    {
        $outcomes = array();
        foreach($this->assignments as $assignment)
        {
            foreach($assignment->learningOutcomes as $outcome)
                if (!in_array($outcome, $outcomes))
                    $outcomes[] = $outcome;
        }

        sort($outcomes);
        return $outcomes;
    }
}

?>
