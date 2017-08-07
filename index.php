<?php

    $trip_data_file = __DIR__ . '/data/trip_data.json';

    $trip_data = json_decode(file_get_contents($trip_data_file), true);

    if(is_array($trip_data)) {

        include_once(__DIR__ . '/includes/trip_data_sotrer_class.php');

        $trip_data_sotrer = new trip_data_sotrer_class($trip_data);

        $transportation_types = $trip_data_sotrer->trip_data_sort()->get_transportation_types($trip_data);

        if ($count = count($transportation_types)) {

            echo PHP_EOL . str_repeat('-', 150) . PHP_EOL;
            echo 'Trip Data File: ' . $trip_data_file;
            echo PHP_EOL . str_repeat('-', 150) . PHP_EOL;
            
            foreach ($transportation_types as $index => $type) {
                
                echo PHP_EOL . " * " . $type->getMessage();
                
                if($index == $count - 1) {
                    echo " * You have arrived at your final destination." . PHP_EOL;
                }
                    
            }
            
        }
        
        echo PHP_EOL . str_repeat('-', 150) . PHP_EOL;

    }
    else {

        return "Invalid Trip Data: Please check the input file and make sure to fix it. [Trip Data File: {$trip_data_file}]." . PHP_EOL;

    }