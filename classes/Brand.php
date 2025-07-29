<?php

class Brand {
    private $id;
    private $name;
    private $description;
    private $created_at;
    private $updated_at;

    /**
     * Retorna todas las marcas
     * @return Brand[] Retorna todas las marcas o un array vacio si no se encuentran
     */
    public static function getAll(): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM brands";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $brands = $PDOStatement->fetchAll();

            return $brands ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    /** 
     * Retorna un marca específico por ID
     * @param int $id ID de la marca
     * @return Brand|null Retorna la marca o null si no se encuentra
     */
    public static function getById($id): ?Brand {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM brands WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute([$id]);
    
            $brand = $PDOStatement->fetch();
    
            return $brand ?: null;
        } catch (PDOException $e) {
            return null;
        } 
    }

    /** 
     * Crea una nueva marca
     * @param string $name Nombre de la marca
     * @param string $description Descripción de la marca
     * @return bool Retorna true si la marca se creó correctamente, false si hubo un error
     */
    public static function create($name, $description): bool {
        $conexion = DbConnection::getConexion();
        $query = "INSERT INTO brands (name, description, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$name, $description]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

     /**
     * Edita una marca existente
     * @param int $id ID de la marca a editar
     * @param string $name Nombre de la marca
     * @param string $description Descripción de la marca
     * @return bool Retorna true si se actualizó la marca correctamente, false si hubo un error
     */
    public static function edit($id, $name, $description): bool {
        $conexion = DbConnection::getConexion();
        $query = "UPDATE brands SET name = ?, description = ?, updated_at = NOW() WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$name, $description, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

     /**
     * Elimina una marca por ID.
     * @param int $id ID de la marca a eliminar
     * @return bool Retorna true si se eliminó correctamente, false si hubo un error
     */
    public static function delete($id): bool {
        $conexion = DbConnection::getConexion();
        $query = "DELETE FROM brands WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$id]);

            return $PDOStatement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID de la marca
     */
    public function setId($value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre de la marca
     */
    public function setName($value): void {
        $this->name = $value;
    }

    /** 
     * Asigna el valor a $description
     * @param string $value Descripción de la marca
     */
    public function setDescription($value): void {
        $this->description = $value;
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
     * @return int ID de la marca
     */
    public function getId(): int {
        return $this->id;
    }

    /** 
     * Obtiene el valor de $name
     * @return string Nombre de la marca
     */
    public function getName(): string {
        return $this->name;
    }

    /** 
     * Obtiene el valor de $description
     * @return string Descripción de la marca
     */
    public function getDescription(): string {
        return $this->description;
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
