<?php

class Role {
    private $id;
    private $name;
    private $active;

    /**
     * Retorna todos los roles disponibles.
     * @return Role[] Retorna todos los roles
     */
    public static function getAll(): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM roles";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();

            $roles = $PDOStatement->fetchAll();

            return $roles ?: [];
        } catch (PDOException $e) {
            error_log("Error al consultar los roles: " . $e->getMessage());
            return [];
        }
    }

    /** 
     * Retorna un rol específico por ID.
     * @param int $id ID del rol
     * @return Role|null Retorna el rol o null si no se encuentra
     */
    public static function getById($id): ?Role {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM roles WHERE id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute([$id]);
    
            $role = $PDOStatement->fetch();
    
            return $role ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID del rol
     */
    public function setId($value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre del rol
     */
    public function setName($value): void {
        $this->name = $value;
    }

    /** 
     * Asigna el valor a $active
     * @param bool $value Estado activo del rol
     */
    public function setActive($value): void {
        $this->active = $value;
    }

    // Getters

    /** 
     * Obtiene el valor de $id
     * @return int ID del rol
     */
    public function getId(): int {
        return $this->id;
    }

    /** 
     * Obtiene el valor de $name
     * @return string Nombre del rol
     */
    public function getName(): string {
        return $this->name;
    }

    /** 
     * Obtiene el valor de $active
     * @return bool Estado activo del rol
     */
    public function getActive(): bool {
        return $this->active;
    }

}

?>