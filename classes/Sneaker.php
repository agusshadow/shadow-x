<?php 

class Sneaker {
    private int $id;
    private string $name;
    private string $description;
    private int $price;
    private string $image;
    private Brand $brand;
    private Category $category;
    private string $created_at;
    private string $updated_at;
    private array $sizes = [];

    private static $createValues = ['id', 'name', 'description', 'price', 'image', 'created_at', 'updated_at'];

    /**
     * Devuelve una instancia del objeto Sneaker, con todas sus propiedades configuradas
     * @param array $sneakerData Datos del sneaker
     * @return Sneaker
     */
    private static function createSneakerInstance(array $sneakerData): Sneaker {
        $sneaker = new self();

        foreach (self::$createValues as $value) {
            $sneaker->{$value} = $sneakerData[$value];
        }

        $sneaker->brand = Brand::getById($sneakerData['brand_id']);
        $sneaker->category = Category::getById($sneakerData['category_id']);
        
        if (!empty($sneakerData['sizes'])) {
            $sneaker->sizes = [];
            foreach ($sneakerData['sizes'] as $sizeData) {
                $size = new Size();
                $size->setId($sizeData['id']);
                $size->setSize($sizeData['size']);
                $size->setGender($sizeData['gender']);
                $sneaker->sizes[] = $size;
            }
        }

        return $sneaker;
    }

    /** 
     * Retorna todos los sneakers
     * @return Sneaker[] retorna todos los sneakers
     */
    public static function getSneakers(): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sneakers";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute();
            
            $sneakers = [];
            while ($result = $PDOStatement->fetch()) {
                $sneakers[] = self::createSneakerInstance($result);
            }
            return $sneakers;
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function getSneakerById(int $id): ?Sneaker {
        $conexion = DbConnection::getConexion();
        
        $query = "SELECT * FROM sneakers WHERE id = ?";
        
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$id]);
    
            $sneakerData = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
            if ($sneakerData) {
                $sizesQuery = "
                    SELECT s.id, s.size, s.gender 
                    FROM sizes s
                    JOIN sneaker_sizes ss ON s.id = ss.size_id
                    WHERE ss.sneaker_id = ?";
    
                $PDOStatementSizes = $conexion->prepare($sizesQuery);
                $PDOStatementSizes->execute([$id]);
    
                $sizes = $PDOStatementSizes->fetchAll(PDO::FETCH_ASSOC);
    
                $formattedSizes = [];
                foreach ($sizes as $size) {
                    $formattedSizes[] = [
                        'id' => $size['id'],
                        'size' => $size['size'],
                        'gender' => $size['gender']
                    ];
                }

                $sneakerData['sizes'] = $formattedSizes;
    
                return self::createSneakerInstance($sneakerData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }    

    /** 
     * Retorna los sneakers filtrados por marca
     * @param int $brand_id ID de la marca a filtrar
     * @return Sneaker[] Retorna un array con los sneakers de la marca especificada
     */
    public static function getSneakersByBrand(int $brand_id): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sneakers WHERE brand_id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$brand_id]);

            $sneakers = [];
            while ($sneakerData = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                $sneakers[] = self::createSneakerInstance($sneakerData);
            }

            return $sneakers;
        } catch (PDOException $e) {
            return [];
        }
    }

    /** 
     * Retorna los sneakers filtrados por marca
     * @param int $brand_id ID de la marca a filtrar
     * @return Sneaker[] Retorna un array con los sneakers de la marca especificada
     */
    public static function getSneakersByCategory(int $categoryId): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sneakers WHERE category_id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$categoryId]);

            $sneakers = [];
            while ($sneakerData = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                $sneakers[] = self::createSneakerInstance($sneakerData);
            }

            return $sneakers;
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function getSneakersByName(string $name): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT * FROM sneakers WHERE name LIKE ?";
        
        try {
            $PDOStatement = $conexion->prepare($query);
            $search = "%" . $name . "%";
            $PDOStatement->execute([$search]);
    
            $sneakerDataList = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    
            if ($sneakerDataList) {
                $sneakers = [];
                foreach ($sneakerDataList as $sneakerData) {
                    $sneakers[] = self::createSneakerInstance($sneakerData);
                }
                return $sneakers;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public static function getSneakersByFilter(array $filters): array {
        $conexion = DbConnection::getConexion();
        
        $query = "SELECT * FROM sneakers WHERE 1=1";
        $params = [];

        if (!empty($filters['search'])) {
            $query .= " AND name LIKE ?";
            $params[] = "%" . $filters['search'] . "%";
        }

        if (!empty($filters['brandId'])) {
            $query .= " AND brand_id = ?";
            $params[] = $filters['brandId'];
        }

        if (!empty($filters['categoryId'])) {
            $query .= " AND category_id = ?";
            $params[] = $filters['categoryId'];
        }

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute($params);

            $sneakers = [];
            while ($sneakerData = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                $sneakers[] = self::createSneakerInstance($sneakerData);
            }

            return $sneakers;
        } catch (PDOException $e) {
            error_log("Error al consultar los sneakers: " . $e->getMessage());
            return [];
        }
    }

     /**
     * Obtiene los tamaños y su stock asociados a este sneaker.
     * @param int $sneakerId
     * @return array
     */
    public function getSizesWithStock(int $sneakerId): array {
        $conexion = DbConnection::getConexion();
        $query = "SELECT ss.size_id, ss.stock, s.size 
                  FROM sneaker_sizes ss
                  JOIN sizes s ON ss.size_id = s.id
                  WHERE ss.sneaker_id = ?";

        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$sneakerId]);

            $sizesWithStock = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

            return $sizesWithStock ?: [];
        } catch (PDOException $e) {
            error_log("Error al consultar los tamaños y stock del sneaker: " . $e->getMessage());
            return [];
        }
    }

     /**
     * Obtiene los tamaños y su stock asociados a este sneaker.
     * @param array $sneakerData Informacion del sneaker
     * @param array $sizes Los talles a linkear con el sneaker
     * @return array
     */
    public static function create(array $sneakerData, array $sizes): void {
        $conexion = DbConnection::getConexion();

        $query = "INSERT INTO sneakers (name, description, price, image, brand_id, category_id, created_at, updated_at) 
                VALUES (:name, :description, :price, :image, :brand_id, :category_id, NOW(), NOW())";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'name' => $sneakerData['name'],
            'description' => $sneakerData['description'],
            'price' => $sneakerData['price'],
            'image' => $sneakerData['image'],
            'brand_id' => $sneakerData['brand_id'],
            'category_id' => $sneakerData['category_id']
        ]);

        $sneakerId = $conexion->lastInsertId();

        foreach ($sizes as $sizeId => $stock) {
            $query = "INSERT INTO sneaker_sizes (sneaker_id, size_id, stock) 
                    VALUES (:sneaker_id, :size_id, :stock)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                'sneaker_id' => $sneakerId,
                'size_id' => $sizeId,
                'stock' => $stock
            ]);
        }
    }

     /**
     * Edita un sneaker existente
     * @param array $sneakerData Informacion del sneaker
     * @param array $sizez Talles a aplicar al sneaker
     * @return bool Retorna TRUE si se actualizó el sneaker correctamente, FALSE si hubo un error
     */
    public function edit($sneakerData, $sizes) {
        $conexion = DbConnection::getConexion();
        $query = "UPDATE sneakers SET
                name = :name,
                description = :description,
                price = :price,
                image = :image,
                brand_id = :brand_id,
                category_id = :category_id
                WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'id' => $this->id,
            'name' => $sneakerData['name'],
            'description' => $sneakerData['description'],
            'price' => $sneakerData['price'],
            'image' => $sneakerData['image'],
            'brand_id' => $sneakerData['brand_id'],
            'category_id' => $sneakerData['category_id']
        ]);

        $this->updateSizes($sizes);
    }

    /**
     * Edita los talles existentes
     * @param array $sizes Talles a actualizar
     * @return bool Retorna TRUE si se actualizó el sneaker correctamente, FALSE si hubo un error
     */
    public function updateSizes($sizes) {
        $conexion = DbConnection::getConexion();

        $queryDelete = "DELETE FROM sneaker_sizes WHERE sneaker_id = :sneaker_id";
        $PDOStatementDelete = $conexion->prepare($queryDelete);
        $PDOStatementDelete->execute(['sneaker_id' => $this->id]);

        $queryInsert = "INSERT INTO sneaker_sizes (sneaker_id, size_id, stock) VALUES (:sneaker_id, :size_id, :stock)";
        foreach ($sizes as $sizeId => $stock) {
            $PDOStatementInsert = $conexion->prepare($queryInsert);
            $PDOStatementInsert->execute([
                'sneaker_id' => $this->id,
                'size_id' => $sizeId,
                'stock' => $stock
            ]);
        }
    }

    /**
     * Elimina un sneaker por ID.
     * @param int $id ID del sneaker a eliminar
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario
     */
    public function delete() {
        $conexion = DbConnection::getConexion();
        $query = "DELETE FROM sneakers WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }


    /**
     * Elimina los talles existentes
     * @return bool Retorna TRUE si se booraron los talles correctamente, FALSE si hubo un error
     */
    public function clearSizes() {
        $conexion = DbConnection::getConexion();
        $query = "DELETE FROM sneaker_sizes WHERE sneaker_id = :sneaker_id";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'sneaker_id' => $this->id
        ]);
    }

    /** 
     * Retorna el precio con el prefijo "US$"
     * @return string retorna el precio con el formato "US$"
     */
    public function getPriceWithUsdPrefix(): string {
        return "US$ " . $this->getPrice();
    }

    // Setters

    /** 
     * Asigna el valor a $id
     * @param int $value ID del sneaker
     * @return void
     */
    public function setId(int $value): void {
        $this->id = $value;
    }

    /** 
     * Asigna el valor a $name
     * @param string $value Nombre del sneaker
     * @return void
     */
    public function setName(string $value): void {
        $this->name = $value;
    }

    /** 
     * Asigna el valor a $description
     * @param string $value Descripción del sneaker
     * @return void
     */
    public function setDescription(string $value): void {
        $this->description = $value;
    }

    /** 
     * Asigna el valor a $price
     * @param float $value Precio del sneaker
     * @return void
     */
    public function setPrice(float $value): void {
        $this->price = $value;
    }

    /** 
     * Asigna el valor a $image
     * @param string $value URL de la imagen del sneaker
     * @return void
     */
    public function setImage(string $value): void {
        $this->image = $value;
    }

    /** 
     * Asigna el valor a $brand_id
     * @param int $value ID de la marca
     * @return void
     */
    public function setBrand(int $value): void {
        $this->brand = $value;
    }

    /** 
     * Asigna el valor a $category_id
     * @param int $value ID de la categoría
     * @return void
     */
    public function setCategory(int $value): void {
        $this->category = $value;
    }

    /** 
     * Asigna el valor a $created_at
     * @param string $value Fecha de creación
     * @return void
     */
    public function setCreatedAt(string $value): void {
        $this->created_at = $value;
    }

    /** 
     * Asigna el valor a $updated_at
     * @param string $value Fecha de actualización
     * @return void
     */
    public function setUpdatedAt(string $value): void {
        $this->updated_at = $value;
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

    /** 
     * Obtiene el valor de $description
     * @return string Descripción del sneaker
     */
    public function getDescription(): string {
        return $this->description;
    }

    /** 
     * Obtiene el valor de $price
     * @return float Precio del sneaker
     */
    public function getPrice(): float {
        return $this->price;
    }

    /** 
     * Obtiene el valor de $image
     * @return string URL de la imagen del sneaker
     */
    public function getImage(): string {
        return $this->image;
    }

    /** 
     * Obtiene el valor de $brand
     * @return int ID de la marca
     */
    public function getBrandId(): string {
        return $this->brand->getId();
    }

    /** 
     * Obtiene el valor de $brand
     * @return int ID de la marca
     */
    public function getBrand(): string {
        return $this->brand->getName();
    }

    /** 
     * Obtiene el valor de $category_id
     * @return int ID de la categoría
     */
    public function getCategoryId(): string {
        return $this->category->getId();
    }

    /** 
     * Obtiene el valor de $category_id
     * @return int ID de la categoría
     */
    public function getCategory(): string {
        return $this->category->getName();
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

    /** 
     * Obtiene el valor de $updated_at
     * @return string Fecha de actualización
     */
    public function getSizes(): array {
        return $this->sizes;
    }
}
