<?php

require_once('../lib/jsonschemaphp/jsonSchema.php');

class Course
{
    private $storage;

    public function Course($_courseObj, $_courseID)
    {
        global $ROOT;
        $schemaPath = $ROOT.'utils/courseSchema.json';

        $schemaF = fopen($schemaPath, 'r');
        $schema = json_decode(fread($schemaF, filesize($schemaPath)));
        $result = JsonSchema::validate( $_courseObj, $schema);

        if (!$result->valid) {
            echo "Errors while validating ".$_courseID.": \n";
            print_r($result->errors);
        }
        $this->storage = $_courseObj;
    }

    public function __get($name)
    {
        return $this->storage->$name;
    }

    public function __set($name, $value)
    {
        $this->storage->$name = $value;
    }

    // Returns the JSON representation of this course
    public function toJSON()
    {
        return json_encode($this->storage);
    }
}

?>
