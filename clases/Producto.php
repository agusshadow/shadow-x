<?php 

class Producto {
    protected $producto_id;
    protected $tipo;
    protected $nombre;
    protected $precio;
    protected $imagen;
    protected $alt;
    protected $plataforma;
    protected $descripcion;
    protected $url_video;

    public function traerJuegos() {
        $archivo = __DIR__ . '/../data/productos.json';
        $contenido = file_get_contents($archivo);
        $data = json_decode($contenido, true);
        $productos = [];
        foreach ($data as $valor) {
            $producto = new Producto();
            $producto->setId($valor['id']);
            $producto->setTipo($valor['tipo']);
            $producto->setNombre($valor['nombre']);
            $producto->setPrecio($valor['precio']);
            $producto->setImagen($valor['img']);
            $producto->setAlt($valor['alt']);
            $producto->setPlataforma($valor['plataforma']);
            $producto->setDescripcion($valor['descripcion']);
            $producto->setUrl($valor['url']);
            array_push($productos, $producto);
        };
      return $productos;
    }

    public function traerPorId($id) {
        $productos = (new Producto())->traerJuegos();
        foreach ($productos as $producto) {
            if ($producto->producto_id === $id) {
                return $producto;
            }
        }
        return null;
    }

    public function traerPorTipo($tipo) {
        $productos = (new Producto())->traerJuegos();
        $array_productos = [];
        foreach ($productos as $producto) {
            if ($producto->tipo === $tipo) {
                array_push($array_productos, $producto);
            }
        }
        return $array_productos;
    }

    public function setId($valor) {
        return $this->producto_id = $valor;
    }

    public function setTipo($valor) {
        return $this->tipo = $valor;
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

    public function setAlt($valor) {
        return $this->alt = $valor;
    }

    public function setPlataforma($valor) {
        return $this->plataforma = $valor;
    }

    public function setDescripcion($valor) {
        return $this->descripcion = $valor;
    }

    public function setUrl($valor) {
        return $this->url_video = $valor;
    }

    public function getId() {
        return $this->producto_id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getAlt() {
        return $this->alt;
    }

    public function getPlataforma() {
        return $this->plataforma;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getUrl() {
        return $this->url_video;
    }

};

?>