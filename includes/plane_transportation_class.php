<?php

    include_once(__DIR__ . '/abstract_transportation_class.php');

    /**
     * Class Plane Transportation Class
     *
     */
    class plane_transportation_class extends abstract_transportation_class {

        /**
         * @var string
         */
        protected $transportationNumber;

        /**
         * @var string
         */
        protected $seat;

        /**
         * @var string
         */
        protected $gate;

        /**
         * @var string
         */
        protected $baggage;

        /**
         * Return a message for the trip, defined in Transportation Interface
         *
         * @return string
         */
        public function getMessage() {
            
            $message = "From {$this->departure} take flight {$this->transportationNumber} to {$this->arrival} [Gate {$this->gate}, Seat {$this->seat}]. Baggage will we automatically transferred from your last leg.";

            // Add Baggage message
            if (!empty($this->baggage)) {
                $message = "Baggage drop at ticket counter {$this->baggage}.";
            }

            return $message;
        }
        
    }
