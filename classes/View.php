<?php

class View {
    private $id;
    private $name;
    private $title;
    private $active;
    private $restricted;

    /**
     * Valida el identificador de una vista y devuelve un objeto View correspondiente.
     * Si la vista no está activa, retorna una vista de error 403.
     * Si la vista no existe, retorna una vista de error 404.
     *
     * @param ?string $vista El nombre identificador de la vista (por ejemplo: 'home', 'admin-orders', etc.)
     * @return View Retorna una instancia de View válida o una vista de error
     */
    public static function validate(?string $vista): View
    {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM views WHERE name = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$vista]);

        $viewData = $PDOStatement->fetch();

        if ($viewData) {
            if ($viewData->getActive()) {
                $resultado = $viewData;
            } else {
                $view403 = new self();
                $view403->name = 'no_disponible';
                $view403->title = 'Página no disponible';
                $view403->restricted = 0;
                $resultado = $view403;
            }
        } else {
            $view404 = new self();
            $view404->name = '404';
            $view404->title = 'Página no Encontrada';
            $view404->restricted = 0;
            $resultado = $view404;
        }

        return $resultado;
    }

    // Getters y Setters

    /**
     * Obtiene el ID de la vista
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el ID de la vista
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Obtiene el nombre identificador de la vista
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Asigna el nombre de la vista
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Obtiene el título que se muestra en la página
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Asigna el título de la vista
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Indica si la vista está activa (1) o no (0)
     * @return bool|int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Define si la vista está activa
     * @param bool|int $active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Indica si la vista está restringida (1) o no (0)
     * @return bool|int
     */
    public function getRestricted()
    {
        return $this->restricted;
    }

    /**
     * Define si la vista requiere autorización
     * @param bool|int $restricted
     * @return self
     */
    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;
        return $this;
    }
}

?>
