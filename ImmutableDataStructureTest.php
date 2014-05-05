<?php

include_once("ImmutableDataStructure.php");

abstract class ImmutableDataStructureTestCase extends PHPUnit_Framework_TestCase {}

class ImmutableDataStructureWithNoAttributes extends ImmutableDataStructure {
}

class ImmutableDataStructure_GivenNoAttributes extends ImmutableDataStructureTestCase {
    private $immutable;

    function setUp(){
        $this->immutable = new ImmutableDataStructureWithNoAttributes();
    }

    function test_WhenAddingAnAttribute_ShouldThrowException(){
        static::SetExpectedException("ImmutableModificationException");
        $this->immutable->anAttribute = "foo";
    }

    function test_WhenTransformingToJson_ShouldBeEmptyObject(){
        static::AssertSame("{}", json_encode($this->immutable));
    }
}

class ImmutableDataStructureWithAnAttribute extends ImmutableDataStructure {
    protected $anAttribute;

    function __construct(){
        $this->anAttribute = "foo";
    }
}

class ImmutableDataStructure_GivenAnAttribute extends ImmutableDataStructureTestCase {
    private $immutable;

    function setUp(){
        $this->immutable = new ImmutableDataStructureWithAnAttribute();
    }

    function test_WhenTryingToEditAnAttribute_ShouldThrowException(){
        static::SetExpectedException("ImmutableModificationException");
        $this->immutable->anAttribute = "foo";
    }

    function test_WhenTransformingToJson_ShouldBeEmptyObject(){
        static::AssertSame("{\"anAttribute\":\"foo\"}", json_encode($this->immutable));
    }
}
