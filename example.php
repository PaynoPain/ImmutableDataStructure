<?php

function doSomethingUnexpected($person){
    //I will be born sometime else!!
    $person->birth_date = "2000-01-01 00:10:02.999";
}

$mutable_person = new stdClass();
$mutable_person->name = "John";
$mutable_person->birth_date = "1980-10-10 20:01:20.421";

echo "MUTABLE PERSON:\n";
echo "====================================\n";
echo "Before the unexpected:\n";
echo json_encode($mutable_person) . "\n";

echo "After the unexpected:\n";
doSomethingUnexpected($mutable_person);
//The past has changed!
echo json_encode($mutable_person) . "\n";
echo "\n";

include_once("ImmutableDataStructure.php");

class Person extends ImmutableDataStructure {
    protected $name, $birth_date;

    public function __construct($name, $birthDate){
        $this->name = $name;
        $this->birth_date = $birthDate;
    }
}

$immutable_person = new Person("John", "1980-10-10 20:01:20.421");

echo "IMMUTABLE PERSON:\n";
echo "====================================\n";
echo "Before the unexpected:\n";
echo json_encode($immutable_person) . "\n";

echo "After the unexpected:\n";
try {
    doSomethingUnexpected($immutable_person);
} catch (ImmutableModificationException $e){
    echo "Someone is trying to change the past!\n";
}
echo json_encode($immutable_person) . "\n";
echo "\n";