<?php

class Animal {
    // Properties
    public $name;
    public $legs = 4;
    public $cold_blooded = "no";

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }
}

?>