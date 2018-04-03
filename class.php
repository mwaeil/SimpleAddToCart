<?php

    class SimpleCart{

        public $products;


        function __construct(){
            $this->products = [
                ["Product1","100"],
                ["Product2","200"]
            ];
        }

        public function SearchInCart($prod,$q,$s){
            $ret = false;
            foreach($_SESSION['cart'] as $index => $item) {
                if($item[0] === $prod){
                    $_SESSION['cart'][$index][2] += $q;
                    $_SESSION['cart'][$index][3] += $s;
                    $ret = true;
                    break;
                } 
            }
            return $ret;
        }
       
    }

?>