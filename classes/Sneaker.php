<?php 

class Sneaker {
    private $id;
    private $name;
    private $price;
    private $image;
    private $brand;
    private $description;
    private $sizes;
    private $stock;

    /** 
     * Retorna todos los sneakers
     * @return Sneaker[] retorna todos los sneakers
     */
    public function getSneakers() {
        $file = __DIR__ . '/../data/sneakers.json';
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        $sneakers = [];
        foreach ($data as $value) {
            $sneaker = new Sneaker();
            $sneaker->setId($value['id']);
            $sneaker->setName($value['name']);
            $sneaker->setPrice($value['price']);
            $sneaker->setImage($value['image']);
            $sneaker->setBrand($value['brand']);
            $sneaker->setDescription($value['description']);
            $sneaker->setSizes($value['sizes']);
            $sneaker->setStock($value['stock']);
            array_push($sneakers, $sneaker);
        };
        return $sneakers;
    }

    /** 
     * Retorna un sneaker específico por ID
     * @param int $id ID del sneaker
     * @return Sneaker|null Retorna el sneaker o null si no se encuentra
     */
    public function getSneakerById(int $id): ?Sneaker {
        $sneakers = (new Sneaker())->getSneakers();
        foreach ($sneakers as $sneaker) {
            if ($sneaker->getId() === $id) {
                return $sneaker;
            }
        }
        return null;
    }

    /** 
     * Retorna los sneakers filtrados por marca
     * @param string $brand Marca a filtrar
     * @return Sneaker[] Retorna un array con los sneakers de la marca especificada
     */
    public function getSneakerByBrand(string $brand): array {
        $sneakers = (new Sneaker())->getSneakers();
        $filteredSneakers = [];
        foreach ($sneakers as $sneaker) {
            if ($sneaker->getBrand() === $brand) {
                $filteredSneakers[] = $sneaker;
            }
        }
        return $filteredSneakers;
    }

    /** 
     * Retorna el precio con el prefijo "US$"
     * @return string retorna el precio con el formato "US$"
     */
    public function getPriceWithUsdPrefix(): string {
        return "US$ " . $this->getPrice();
    }

    /** 
     * Verifica si el sneaker tiene stock
     * @return bool retorna true si el stock es mayor a 0, de lo contrario false
     */
    public function hasStock(): bool {
        return $this->stock > 0;
    }

    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID del sneaker
     * @return void
     */
    public function setId(int $value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre del producto
     * @return void
     */
    public function setName(string $value): void {
        $this->name = $value;
    }

    /** 
     * Asigna el valor a $price
     * @param float $value Precio del producto
     * @return void
     */
    public function setPrice(float $value): void {
        $this->price = $value;
    }

    /** 
     * Asigna el valor a $image
     * @param string $value URL de la imagen del producto
     * @return void
     */
    public function setImage(string $value): void {
        $this->image = $value;
    }

    /** 
     * Asigna el valor a $brand
     * @param string $value Marca del producto
     * @return void
     */
    public function setBrand(string $value): void {
        $this->brand = $value;
    }

    /** 
     * Establece el valor de $description
     * @param string $value Descripción del producto
     * @return void
     */
    public function setDescription(string $value): void {
        $this->description = $value;
    }

    /** 
     * Establece el valor de $sizes
     * @param array $value Array de tallas disponibles para el producto
     * @return void
     */
    public function setSizes(array $value): void {
        $this->sizes = $value;
    }

    /** 
     * Asigna el valor a $stock
     * @param int $value Cantidad de stock del sneaker
     * @return void
     */
    public function setStock(int $value): void {
        $this->stock = $value;
    }


    // Getters

    /** 
     * Obtiene el valor de $id
     * @return int ID del sneaker
     */
    public function getId(): int {
        return $this->id;
    }

    /** 
     * Obtiene el valor de $name
     * @return string Nombre del sneaker
     */
    public function getName(): string {
        return $this->name;
    }

    /** 
     * Obtiene el valor de $price
     * @return float Precio del sneaker
     */
    public function getPrice(): float {
        return $this->price;
    }

    /** 
     * Obtiene el valor de $image
     * @return string URL de la imagen del sneaker
     */
    public function getImage(): string {
        return $this->image;
    }

    /** 
     * Obtiene el valor de $brand
     * @return string Marca del sneaker
     */
    public function getBrand(): string {
        return $this->brand;
    }

    /** 
     * Obtiene el valor de $description
     * @return string Descripción del sneaker
     */
    public function getDescription(): string {
        return $this->description;
    }

    /** 
     * Obtiene el valor de $sizes
     * @return array Array de tallas del sneaker
     */
    public function getSizes(): array {
        return $this->sizes;
    }

    /** 
     * Obtiene el valor de $stock
     * @return int Cantidad de stock del sneaker
     */
    public function getStock(): int {
        return $this->stock;
    }

}
