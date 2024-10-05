<?php 

class Product {
    private $id;
    private $product_type;
    private $name;
    private $price;
    private $image;
    private $brand;
    private $description;
    private $sizes;

    /** 
     * Retorna todos los productos
     * @return Product[] retorna todos los productos
     */

    public function fetchProducts() {
        $file = __DIR__ . '/../data/products.json';
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        $products = [];
        foreach ($data as $value) {
            $product = new Product();
            $product->setId($value['id']);
            $product->setProductType($value['product_type']);
            $product->setName($value['name']);
            $product->setPrice($value['price']);
            $product->setImage($value['image']);
            $product->setBrand($value['brand']);
            $product->setDescription($value['description']);
            $product->setSizes($value['sizes']);
            array_push($products, $product);
        };
        return $products;
    }

    public function fetchById($id) {
        $products = (new Product())->fetchProducts();
        foreach ($products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        return null;
    }

    public function fetchByType($product_type) {
        $products = (new Product())->fetchProducts();
        $filtered_products = [];
        foreach ($products as $product) {
            if ($product->getProductType() === $product_type) {
                array_push($filtered_products, $product);
            }
        }
        return $filtered_products;
    }

    // Setters

    public function setId($value) {
        $this->id = $value;
    }

    public function setProductType($value) {
        $this->product_type = $value;
    }

    public function setName($value) {
        $this->name = $value;
    }

    public function setPrice($value) {
        $this->precio = $value;
    }

    public function setImage($value) {
        $this->image = $value;
    }

    public function setBrand($value) {
        $this->brand = $value;
    }

    public function setDescription($value) {
        $this->description = $value;
    }

    public function setSizes($value) {
        $this->sizes = $value;
    }

    // Getters
    
    public function getId() {
        return $this->id;
    }

    public function getProductType() {
        return $this->product_type;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->precio;
    }

    public function getImage() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSizes() {
        return $this->sizes;
    }
}
