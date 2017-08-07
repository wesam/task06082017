<?php

    include_once(__DIR__ . '/transportation_interface.php');

    /**
     * Class Abstract Transportation Class
     *
     */
    abstract class abstract_transportation_class implements transportation_interface {

        /**
         * @var string
         */
        protected $departure;

        /**
         * @var string
         */
        protected $arrival;

        const MESSAGE_FINAL_DESTINATION = '';

        /**
         * @param array $trip
         */
        public function __construct(array $trip) {
            foreach ($trip as $key => $value) {
                $property = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
                if (property_exists($this, $property)) {
                    $this->{$property} = $value;
                }
            }
        }

    }

?>