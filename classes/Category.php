<?php

class Category {
    private $id;
    private $name;
    private $description;
    private $created_at;
    private $updated_at;

    /**
     * Retorna todas las categorías
     * @return Category[] Retorna todas las categorías
     */
    public static function getAll(): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM categories";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $categories = $PDOStatement->fetchAll();

            return $categories ?: [];
        } catch (PDOException $e) {
            error_log("Error al consultar las categorías: " . $e->getMessage());
            return [];
        }
    }

    /** 
     * Retorna una categoría específica por ID
     * @param int $id ID de la categoría
     * @return Category|null Retorna la categoría o null si no se encuentra
     */
    public static function getById($id): ?Category {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM categories WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute([$id]);
    
            $category = $PDOStatement->fetch();
    
            return $category;
        } catch (PDOException $e) {
            return null;
        }
    }

    /** 
     * Crea una nueva categoria
     * @param string $name Nombre de la categoria
     * @param string $description Descripción de la categoria
     * @return bool Retorna verdadero si la categoria se creó correctamente
     */
    public static function create($name, $description): bool {
        $conexion = DbConnection::getConexion();
        $query = "INSERT INTO categories (name, description, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$name, $description]);

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return null;
        }
    }

      /**
     * Edita una categoria existente
     * @param int $id ID de la categoria a editar
     * @param string $name Nombre de la categoria
     * @param string $description Descripción de la categoria
     * @return bool Retorna TRUE si se actualizó la categoria correctamente, FALSE si hubo un error
     */
    public static function edit($id, $name, $description): bool {
        $conexion = DbConnection::getConexion();
        $query = "UPDATE categories SET name = ?, description = ?, updated_at = NOW() WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$name, $description, $id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al editar la categoria: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina una categoria por ID.
     * @param int $id ID de la categoria a eliminar
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario
     */
    public static function delete(int $id): bool {
        $conexion = DbConnection::getConexion();
        $query = "DELETE FROM categories WHERE id = ?";

        try {
            $stmt = $conexion->prepare($query);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }


    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID de la categoría
     */
    public function setId($value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre de la categoría
     */
    public function setName($value): void {
        $this->name = $value;
    }

    /** 
     * Asigna el valor a $description
     * @param string $value Descripción de la categoría
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
     * @return int ID de la categoría
     */
    public function getId(): int {
        return $this->id;
    }

    /** 
     * Obtiene el valor de $name
     * @return string Nombre de la categoría
     */
    public function getName(): string {
        return $this->name;
    }

    /** 
     * Obtiene el valor de $description
     * @return string Descripción de la categoría
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