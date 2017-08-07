<?php

    include_once(__DIR__ . '/abstract_transportation_class.php');

    /**
     * Class Bus Transportation Class
     *
     */
    class bus_transportation_class extends abstract_transportation_class {

        /**
         * Return a message for a trip, defined in Transportation Interface
         *
         * @return string
         */
        public function getMessage() {
            return "Take the airport bus from {$this->departure} to {$this->arrival}.";
        }
    }

?>