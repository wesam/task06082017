<?php

    include_once(__DIR__ . '/bus_transportation_class.php');
    include_once(__DIR__ . '/train_transportation_class.php');
    include_once(__DIR__ . '/plane_transportation_class.php');

    /**
     * Class Trip Data Sotrer Class
     *
     */
    class trip_data_sotrer_class {

        /**
         * Array of trips
         *
         * @var array
         */
        private $trip_data = array();

        /**
         * Default set of transportation
         *
         * @var array
         */
        protected static $transportation = array('bus' => 'bus_transportation_class', 'train' => 'train_transportation_class', 'plane' => 'plane_transportation_class');
        
        /**
         * Class constructer
         *
         * @var array
         */
        public function __construct(array $trip_data) {
            $this->trip_data = $trip_data;
//            static::$transportation['bus'] = new stdClass();
//            static::$transportation['train'] = new stdClass();
//            static::$transportation['plane'] = new stdClass();
        }

        /**
         * Extract the first and the last Trip
         *
         * @return array
         */
        private function extract_first_last_trip() {
            
            if (count($this->trip_data) < 2) {
                return $this->trip_data;
            }

            // Find the start and end point for the trips
            for ($i = 0, $max = count($this->trip_data); $i < $max; $i++) {
                $has_previous_trip = false;
                $is_last_trip = true;

                foreach ($this->trip_data as $index => $trip) {
                    // If this trip is attached to a previous trip, we pass!
                    if (strcasecmp($this->trip_data[$i]['departure'], $trip['arrival']) == 0) {
                        $has_previous_trip = true;
                    } // If this trip is not the last trip, we pass!
                    elseif (strcasecmp($this->trip_data[$i]['arrival'], $trip['departure']) == 0) {
                        $is_last_trip = false;
                    }
                }

                // We found the start point of the trip,
                // so we put it on the top of the list
                if (!$has_previous_trip) {
                    array_unshift($this->trip_data, $this->trip_data[$i]);
                    unset($this->trip_data[$i]);
                } // And the end of the trip
                elseif ($is_last_trip) {
                    array_push($this->trip_data, $this->trip_data[$i]);
                    unset($this->trip_data[$i]);
                }

            }

            // Reset indexes
            $this->trip_data = array_merge($this->trip_data);
        }

        /**
         * Sort a trip collection from Departure to Arrival
         *
         * @return $this
         */
        public function trip_data_sort() {
            $this->extract_first_last_trip();
            $this->paring_trips();
            return $this;
        }

        /**
         * Paring trips
         */
        private function paring_trips() {
            
            // Start pairing trips
            for ($i = 0, $max = count($this->trip_data) - 1; $i < $max; $i++) {

                foreach ($this->trip_data as $index => $trip) {

                    if (strcasecmp($this->trip_data[$i]['arrival'], $trip['departure']) == 0) {
                        $nextIndex = $i + 1;
                        $tempRow = $this->trip_data[$nextIndex];
                        $this->trip_data[$nextIndex] = $trip;
                        $this->trip_data[$index] = $tempRow;

                        break;
                    }
                }
            }
        }

        /**
         * Get sorted transportation as an array of objects
         *
         * @return array
         */
        public function get_transportation_types() {
            
            $transportation_types = array();

            if (count($this->trip_data) == 0) {
                return $transportation_types;
            }

            foreach ($this->trip_data as $trip) {
                $type = strtolower($trip['transportation']);
                if (!isset(static::$transportation[$type])) {
                    throw new Exception("Unsupported transportation : {$type}");
                }
                $transportation_types[] = new static::$transportation[$type]($trip);
            }

            return $transportation_types;

        }

        /**
         * Get the sorted Trips
         *
         * @return array
         */
        public function get_sorted_trips() {
            return $this->trip_data;
        }
    }

?>