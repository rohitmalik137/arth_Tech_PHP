<?php require('./databse.php'); ?>
<?php
    class Hotel{
        private $name;
        private $apartment;
        private $floor;
        private $tfloor;
        private $price;
        private $city;
        private $society;
        private $roomSize;
        private $myValue;
        private $comment;
        private $id;

        public static function insertData($name, $apartment, $floor, $tfloor, $price, $city, $society, $roomSize){
            global $database;
            $name = $database->escape_string($name);
            $apartment = $database->escape_string($apartment);
            $floor = $database->escape_string($floor);
            $tfloor = $database->escape_string($tfloor);
            $price = $database->escape_string($price);
            $city = $database->escape_string($city);
            $society = $database->escape_string($society);
            $roomSize = $database->escape_string($roomSize);

            $sql = "INSERT INTO `myTable`(`name`, `apartment`, `floor`, `total_floor`, `price`, `city`, `society`, `room_size`) VALUES ('{$name}', '{$apartment}', '{$floor}', '{$tfloor}', '{$price}', '{$city}', '{$society}', '{$roomSize}')";
            $result = $database->query($sql);
            return $result;
        }

        public static function fetchData($myValue){
            global $database;
            $myValue = $database->escape_string($myValue);

            switch($myValue){
                case 'Price_low_to_high':
                    $sql = "SELECT * FROM `myTable` ORDER BY `price` ASC";
                    break;
                case 'Price_high_to_low':
                    $sql = "SELECT * FROM `myTable` ORDER BY `price` DESC";
                    break;
                case 'RoomSize':
                    $sql = "SELECT * FROM `myTable` ORDER BY `room_size` DESC";
                    break;
                default:
                    $sql = "SELECT * FROM `myTable` ORDER BY `room_size` DESC";
            }
            $result = $database->query($sql);

            return $result;
        }

        public static function addComment($comment, $id){
            global $database;
            $comment = $database->escape_string($comment);
            $id = $database->escape_string($id);

            $sql = "UPDATE `mytable` SET `comments`='{$comment}' WHERE `id`='{$id}'";
            $result = $database->query($sql);
        }
    }
?>