<?php

function sortCars($cars, $sort) {
    $sortedCars = $cars;
    if ($sort == 'name') {
        usort($sortedCars, function($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });
    } else if ($sort == 'engine') {
        usort($sortedCars, function($a, $b) {
            return strcmp($a->getEngine(), $b->getEngine());
        });
    } else if ($sort == 'year') {
        usort($sortedCars, function($a, $b) {
            return $a->getYear() - $b->getYear();
        });
    } else if ($sort == 'km') {
        usort($sortedCars, function($a, $b) {
            return $a->getKm() - $b->getKm();
        });
    }
    return $sortedCars;
}


function displayCars($cars) {
    foreach ($cars as $car) {
        return 'Name :' . $car->getName() . ' | Engine :' . $car->getEngine() . ' | Year :' . $car->getYear() . ' | mileage :' . $car->getKm();
    }
}


function getAllYears($cars) {
    $years = [];
    foreach ($cars as $car) {
        $years[] = $car->getYear();
    }
    return $years;
}


function filterCars($cars, $minMileage = 0, $maxMileage = 999999999, $engine = null, $exactYear = null, $name = null , $minYear = 0, $maxYear = 999999999) {
    $filteredCars = [];
    foreach ($cars as $car) {
        if (($car->getKm() >= $minMileage && $car->getKm() <= $maxMileage) || $car->getYear() == $exactYear) {
            if ($engine == null || $car->getEngine() == $engine) {
                if ($exactYear == null || $car->getYear() == $exactYear) {
                    if ($name == null || $car->getName() == $name) {
                        $filteredCars[] = $car;
                    }
                }
            }
        }
    }
    return $filteredCars;
}