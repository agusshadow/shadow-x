<?php

class Size {
    private $id;
    private $size;
    private $gender;
    private $created_at;
    private $updated_at;

    /**
     * Retorna todos los tamaños disponibles.
     * @return Size[] Retorna todos los tamaños
     */
    public static function getAll(): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sizes";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $sizes = $PDOStatement->fetchAll();

            return $sizes ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    /** 
     * Retorna un tamaño específico por ID.
     * @param int $id ID del tamaño
     * @return Size|null Retorna el tamaño o null si no se encuentra
     */
    public static function getById($id): ?Size {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sizes WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute([$id]);
    
            $size = $PDOStatement->fetch();
    
            return $size ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID del tamaño
     */
    public function setId($value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $size
     * @param float $value Tamaño de la zapatilla
     */
    public function setSize($value): void {
        $this->size = $value;
    }

    /** 
     * Asigna el valor a $gender
     * @param string $value Género ('Men' o 'Women')
     */
    public function setGender($value): void {
        $this->gender = $value;
    }

    /** 
     * Asigna el valor a $created_at
     * @param string $value Fecha de creación
     */
    public function setCreatedAt($value): void {
        $this->created_at = $value;
    }

    /** 
     * Asigna el valor a $updated_at
     * @param string $value Fecha de actualización
     */
    public function setUpdatedAt($value): void {
        $this->updated_at = $value;
    }

    // Getters

    /** 
     * Obtiene el valor de $id
     * @return int ID del tamaño
     */
    public function getId(): int {
        return $this->id;
    }

    /** 
     * Obtiene el valor de $size
     * @return float Tamaño de la zapatilla
     */
    public function getSize(): float {
        return $this->size;
    }

    /** 
     * Obtiene el valor de $gender
     * @return string Género ('Men' o 'Women')
     */
    public function getGender(): string {
        return $this->gender;
    }

    /** 
     * Obtiene el valor de $created_at
     * @return string Fecha de creación
     */
    public function getCreatedAt(): string {
        return $this->created_at;
    }

    /** 
     * Obtiene el valor de $updated_at
     * @return string Fecha de actualización
     */
    public function getUpdatedAt(): string {
        return $this->updated_at;
    }
}

?>