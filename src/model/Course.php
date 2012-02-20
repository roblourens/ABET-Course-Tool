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

    // includes instructors and course coordinators
    // will probably be a comma-separated list but we can let the user deal with that
    public $instructors = "";

    // { "progID": "E", "progID2": "R" }
    public $reqForProgram = array();

    // modification dates
    public $descMod = "";       // modification of description
    public $outcomesMod = "";   // modification of student outcomes to course mapping
    public $assignMod = "";     // sample assignments modification   

    // groups for checking modifications
    // only includes the editable ones
    private $descProperties = array('instructors', 'description', 'syllabus', 'courseLearningOutcomes');


    // load from file, or create an empty one
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

            $this->descMod = $_courseArray['descMod'];
            $this->outcomesMod = $_courseArray['outcomesMod'];
            $this->assignMod= $_courseArray['assignMod'];

            // can be removed once all test data files have new fields
            if (isset($_courseArray['reqForProgram']))
                $this->reqForProgram = $_courseArray['reqForProgram'];
            if (isset($_courseArray['instructors']))
                $this->instructors = $_courseArray['instructors'];

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

    public function matchesOutcome($searchOutcome)
    {
        return in_array($searchOutcome, $this->allOutcomes());
    }

    // for every mutable variable, check whether it has changed, if so,
    // update the variable and the modified time for the appropriate section.
    // Returns true if the file changed. false otherwise
    public function update($course)
    {
        $changed = $course != $this? true : false;

        // Check whether any of the descProperties have changed
        foreach ($this->descProperties as $descProperty)
        {
            print("Checking ".$descProperty."\n");
            if ($this->$descProperty != $course->$descProperty)
            {
                $this->descMod = time();
                $this->$descProperty = $course->$descProperty;
            }
        }

        // Check whether any assignments have changed
        if ($this->assignments != $course->assignments)
        {
            // Find the assignment that changed
            foreach ($this->assignments as $assignKey=>$thisAssignment)
            {
                $otherAssignment = $course->assignments[$assignKey];
                if ($otherAssignment != null)
                {
                    // Check which assignments-related mod time to change
                    if ($thisAssignment->learningOutcomes != $otherAssignment->learningOutcomes)
                        $this->outcomesMod = time();
                    if ($thisAssignment->assignmentFileName != $otherAssignment->assignmentFileName ||
                        $thisAssignment->sampleFileNames != $otherAssignment->sampleFileNames)
                        $this->assignMod = time();
                }
                // The assignment was deleted
                else
                {
                    $this->outcomesMod = time();
                    $this->assignMod = time();
                }
            }

            // Necessary in case an assignment was added (could also do this at the point the assignment
            // is actually added, but I think it makes more sense to set all the mod times at once)
            if (count($this->assignments) < count($course->assignments))
            {
                $this->outcomesMod = time();
                $this->assignMod = time();
            }

            $this->assignments = $course->assignments;
        }

        // don't replace, merge
        if ($this->reqForProgram != $course->reqForProgram)
        {
            foreach ($course->reqForProgram as $progID=>$reqType)
                $this->reqForProgram[$progID] = $reqType;
        }

        return $changed;
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
