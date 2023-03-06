<?php
class car {
    private $name;
    private $engine;
    private $year;
    private $mileage;

    public function __construct($name, $engine, $year, $mileage) {
        $this->name = $name;
        $this->engine = $engine;
        $this->year = $year;
        $this->mileage = $mileage;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getEngine() {
        return $this->engine;
    }

    public function getYear() {
        return $this->year;
    }

    public function getmileage() {
        return $this->mileage;
    }

    public function setmileage($mileage) {
        $this->mileage = $mileage;
    }
}