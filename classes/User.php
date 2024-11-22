<?php

class User {

    private $id;
    private $email;
    private $name;
    private $password;
    private $role;

    private static $createValues = ['id', 'email', 'name', 'password'];

    /**
     * Devuelve una instancia del objeto Sneaker, con todas sus propiedades configuradas
     * @param array $sneakerData Datos del sneaker
     * @return Sneaker
     */
    private static function createUserInstance(array $userData): User {
        $user = new self();

        // Asignación de los valores comunes del sneaker
        foreach (self::$createValues as $value) {
            $user->{$value} = $userData[$value];
        }

        // Asignación de la marca y categoría
        $user->role = Role::getById($userData['role_id']);

        return $user;
    }

    /**
     * Encuentra un usuario por su Username
     * @param string $name El nombre de usuario
     */
    public static function getByName(string $name): ?User
    {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM users WHERE name = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$name]);

        $user = $PDOStatement->fetch();

        if (!$user) {
            return null;
        }
        return self::createUserInstance($user);
    }

    /**
     * Encuentra un usuario por su Username
     * @param string $name El nombre de usuario
     */
    public static function getByEmail(string $email): ?User
    {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM users WHERE email = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$email]);

        $user = $PDOStatement->fetch();

        if (!$user) {
            return null;
        }
        return self::createUserInstance($user);
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nombre_usuario
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of nombre_usuario
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRole()
    {
        return $this->role->getName();
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($role)
    {
        $this->role = $role;

        return $this;
    }
}

?>