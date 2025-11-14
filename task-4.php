<?php 
    class product {
        public $name;
        public $price;

        //конструктор для инициализации свойсьв
        public function __constuct($name, $price) {
            $this->name = $name;
            $this->price = $price;
        }

        //метод для получения цены с учетом скидки
        public function getDiscountedPrice($percent) {
            return $this->price * (1 - $percent / 100);
        }
    }

    //три обьекта product
    $product1 = new product("ТОвар 1", 100);
    $product2 = new product("ТОвар 2", 200);
    $product3 = new product("ТОвар 3", 300);
    
    //HTML таблица
    echo "<table border = '1' cellpadding = '5' cellspacing = '0'>";
    echo "
        <tr>
            <th> название </th>
            <th> цена </th>
            <th> цена со скидкой </th>
        </tr>
    ";

    //выводим данные в таблицу
    $discountPercent = 10;
    $products = [$product1, $product2, $product3 ];

    foreach ($products as $product){
        $discountedPrice = $product->getDiscountedPrice($discountPercent);
        echo "<tr>
                <td>{$product->name}</td>
                <td>{$product->price}</td>
                <td>{$discountedPrice}</td>
            </tr>
            ";
    }

    echo "</table">;
?>
