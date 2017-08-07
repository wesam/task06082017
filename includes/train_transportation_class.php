<?php

    include_once(__DIR__ . '/abstract_transportation_class.php');

    /**
     * Class Train Transportation Class
     *
     */
    class train_transportation_class extends abstract_transportation_class {

        /**
         * @var string
         */
        protected $transportationNumber;

        /**
         * @var string
         */
        protected $seat;

        /**
         * Return a message for the trip, defined in Transportation Interface
         *
         * @return string
         */
        public function getMessage() {
            // Add Transportation & Seat numbers to the message
            $message = "Take train {$this->transportationNumber} from {$this->departure} to {$this->arrival}, Seat: {$this->seat}.";
            return $message;
        }
    }

?>