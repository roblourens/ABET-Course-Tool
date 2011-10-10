<?php

include('../lib/jsonschemaphp/jsonSchema.php');

$json = json_decode("{
  \"a\":1,
  \"b\":\"thing I know is that\",
  \"c\":\"I do exist\"
}");

 
$schema = json_decode("{
  \"type\":\"object\",
  \"properties\":{
    \"a\":{\"type\":\"number\"},
    \"b\":{\"type\":\"string\"}
  },
  \"additionalProperties\":false
}");

$result = JsonSchema::validate($json, $schema);
if (!$result->valid)
    print_r($result->errors);
else
    echo "success\n";


?>
