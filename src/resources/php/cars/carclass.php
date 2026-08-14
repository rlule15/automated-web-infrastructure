<?php
    class Car {
        public $CarID;
        public $carImage;
        public $carMake;
        public $carModel;
        public $carYear;

        // Constructor to initialize the car properties
        public function __construct($CarID, $carImage, $carMake, $carModel, $carYear) {
            $this->CarID = $CarID;
            $this->carImage = $carImage;
            $this->carMake = $carMake;
            $this->carModel = $carModel;
            $this->carYear = $carYear;
        }
    }
?>
