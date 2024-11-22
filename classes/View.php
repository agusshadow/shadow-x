<?php

class View {
    private $id;
    private $name;
    private $title;
    private $active;
    private $restricted;

     /**
     * Valida el identificador de una vista y devuelve un array con los datos de la misma
     * @param ?string $vista El identificador de la vista, o null
     * @return Vista devuelve objeto Vista
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

        }else {
            $view404 = new self();

            $view404->name = '404';
            $view404->title = 'Página no Econtrada';
            $view404->restricted = 0;

            $resultado = $view404;
        }

        return $resultado;

    }


    // Getters y Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getRestricted()
    {
        return $this->restricted;
    }

    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;
        return $this;
    }
}

?>
