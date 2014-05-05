<?php

include_once("ImmutableModificationException.php");
include_once("UndefinedPropertyException.php");

abstract class ImmutableDataStructure implements JsonSerializable{
    final function __get($key){
        if (property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new UndefinedPropertyException("$key is undefined");
        }
    }

    final function __set($key, $value){
        throw new ImmutableModificationException("An immutable object can't be modified!");
    }

    public function jsonSerialize(){
        return (Object) get_object_vars($this);
    }
}