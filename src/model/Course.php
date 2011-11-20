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

    // { "progID": "E", "progID2": "R" }
    public $reqForProgram = array();

    // includes instructors and course coordinators
    // will probably be a comma-separated list but we can let the user deal with that
    public $instructors = "";

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

            // can be removed once all test data files have new fields
            if (isset($_courseArray['reqForProgram']))
                $this->statusesForProgram = $_courseArray['reqForProgram'];
            if (isset($_courseArray['instructors']))
                $this->instructors['instructors'];

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

    // for every mutable variable, check whether it has changed, if so,
    // update the variable and the modified time for the appropriate section
    public function update($course)
    {
        if ($this->description != $course->description)
        {
            $this->description = $course->description;
        }

        if ($this->courseLearningOutcomes != $course->courseLearningOutcomes)
        {
            $this->courseLearningOutcomes = $course->courseLearningOutcomes;
        }

        if ($this->syllabus != $course->syllabus)
        {
            $this->syllabus = $course->syllabus;
        }

        // may be tricky
        if ($this->assignments != $course->assignments)
        {
            $this->assignments = $course->assignments;
        }

        // don't replace, merge
        if ($this->reqForProgram != $course->reqForProgram)
        {
            foreach ($course->reqForProgram as $progID=>$reqType)
                $this->reqForProgram[$progID] = $reqType;
        }

        if ($this->instructors != $course->instructors)
        {
            $this->instructors = $course->instructors;
        }
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
