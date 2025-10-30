<?php

require_once 'animal.php';

class Ape extends Animal {
    // Override property legs
    public $legs = 2;

    public function yell() {
        echo "Auooo";
    }
}

?>