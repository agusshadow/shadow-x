<?php 

class Producto {
    protected $juego_id;
    protected $nombre;
    protected $precio;
    protected $imagen;
    protected $plataforma;
    protected $descripcion;

    public function traerJuegos() {
        $archivo = __DIR__ . '/../data/productos.json';
        $contenido = file_get_contents($archivo);
        $data = json_decode($contenido, true);
        $juegos = [];
        foreach ($data as $valor) {
            $juego = new Producto();
            $juego->setId($valor['id']);
            $juego->setNombre($valor['nombre']);
            $juego->setPrecio($valor['precio']);
            $juego->setImagen($valor['img']);
            $juego->setPlataforma($valor['plataforma']);
            $juego->setDescripcion($valor['descripcion']);
            array_push($juegos, $juego);
        };
      return $juegos;
    }

    public function traerPorId($id) {
        $juegos = (new Producto())->traerJuegos();
        foreach ($juegos as $juego) {
            if ($juego->$juego_id === $id) {
                return $juego;
            }
        }
        return null;
    }

    public function setId($valor) {
        return $this->juego_id = $valor;
    }

    public function setNombre($valor) {
        return $this->nombre = $valor;
    }

    public function setPrecio($valor) {
        return $this->precio = $valor;
    }

    public function setImagen($valor) {
        return $this->imagen = $valor;
    }

    public function setPlataforma($valor) {
        return $this->plataforma = $valor;
    }

    public function setDescripcion($valor) {
        return $this->descripcion = $valor;
    }

    public function getId() {
        return $this->$juego_id;
    }

    public function getNombre() {
        return $this->$nombre;
    }

    public function getPrecio() {
        return $this->$precio;
    }

    public function getImagen() {
        return $this->$imagen;
    }

    public function getPlataforma() {
        return $this->$plataforma;
    }

    public function getDescripcion() {
        return $this->$descripcion;
    }

};

?>