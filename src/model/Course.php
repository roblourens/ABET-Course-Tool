<?php

public class Course
{
    private $_deptID;

    private $_courseNum;

    // deptID+courseNum
    private $_courseID;

    private $_description;

    // True if $_syllabus is a file path
    private $_syllabusIsFile;

    // text of syllabus if not a file
    private $_syllabus;

    // Array of [description, how does this apply]?
    private $_otherLearningOutcomes;

    // Array of ['a', 'b'] etc.
    private $_learningOutcomes;

    // Array of Homework objects
    private $_homeworks;

    // Takes an array from the JSON representation of this course
    public _construct($_rawCourseArr)
    {
        
    }

    // getters and setters

    // Returns the JSON representation of this course
    public function toJSON()
    {
        
    }
}


?>
