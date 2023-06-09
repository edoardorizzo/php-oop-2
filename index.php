<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>


<?php

/*

Immaginiamo le classi per modellizzare un personal computer.
Un computer desktop é un computer.
Un computer portatile é un computer.
Creiamo la classe computer come parent class ed estendiamola per le classi desktop e laptop.
Creiamo un set di dati in forma di array di oggetti e stampiamoli a schermo in una card usando bootstrap.
Nella card, indichiamo anche che tipo di prodotto stiamo visualizzando (desktop, laptop) creando un apposito metodo poliforfo in ciascuna sottoclasse.

*/

trait DiscountTrait {
    public function applyDiscount($percentage) {
        $discountedPrice = $this->getPrice() * (1 - $percentage / 100);
        return number_format($discountedPrice, 2);
    }
}
class Computer
{

    public $brand;
    public $model;
    public $price;

    public function __construct($brand, $model, $price)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
    }

    public function getType()
    {
        return "Computer";
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPrice()
    {
        return $this->price;
    }
};
class Desktop extends Computer
{
    public function getType()
    {
        return "Desktop";
    }
}

class Laptop extends Computer
{
    use DiscountTrait;

    public function getType()
    {
        return "Laptop";
    }
}



// dates
$computers = [
    new Desktop("HP", "Desktop 123", 999.99),
    new Laptop("Apple", "Macbook Pro 14", 1499.99),
    new Laptop("Lenovo", "Laptop", 1299.99)
];


// print on screen
foreach ($computers as $computer) {
    echo '<div class="card col-4 m-auto mb-4 mt-4">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $computer->getType() . '</h5>';
    echo '<p class="card-text">Brand: ' . $computer->getBrand() . '</p>';
    echo '<p class="card-text">Model: ' . $computer->getModel() . '</p>';
    echo '<p class="card-text">Price: $' . $computer->getPrice() . '</p>';


    // ad discount only to laptop
    if ($computer instanceof Laptop) {
        $discountedPrice = $computer->applyDiscount(10);
        echo '<p class="card-text">Discounted Price: $' . $discountedPrice . '</p>';
    }

    echo '</div>';
    echo '</div>';
}

?>