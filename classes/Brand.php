<?php

class Brand {
    private $id;
    private $name;

    /**
     * Retorna todas las marcas
     * @return Brand[] retorna todas las marcas
     */
    public static function getBrands(): array {
        $file = __DIR__ . '/../data/brands.json';
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        $brands = [];

        foreach ($data as $value) {
            $brand = new Brand();
            $brand->setId($value['id']);
            $brand->setName($value['name']);
            array_push($brands, $brand);
        }
        return $brands;
    }

    /** 
     * Retorna un brand específico por ID
     * @param int $id ID del brand
     * @return Sneaker|null Retorna el brand o null si no se encuentra
     */
    public static function getBrandById($id): ?Brand {
        $brands = self::getBrands();
        foreach ($brands as $brand) {
            if ($brand->getId() === $id) {
                return $brand;
            }
        }
        return null;
    }

    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID del sneaker
     */
    public function setId($value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre del producto
     */
    public function setName($value): void {
        $this->name = $value;
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
}