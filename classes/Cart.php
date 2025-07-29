<?php

class Cart
{
    /**
     * Clave de sesión para almacenar el carrito
     * @var string
     */
    private string $sessionKey = 'cart';

    /**
     * Constructor que inicializa el carrito en la sesión si no existe
     */
    public function __construct()
    {
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    /**
     * Agrega un producto al carrito
     *
     * @param Sneaker $sneaker Instancia de Sneaker
     * @param int $sizeId ID del talle seleccionado
     * @param int $quantity Cantidad del producto (por defecto 1)
     * @return void
     */
    public function add(Sneaker $sneaker, int $sizeId, int $quantity = 1): void
    {
        $key = $this->generateKey($sneaker->getId(), $sizeId);

        if (isset($_SESSION[$this->sessionKey][$key])) {
            $_SESSION[$this->sessionKey][$key]['quantity'] += $quantity;
        } else {
            $selectedSize = null;
            foreach ($sneaker->getSizes() as $size) {
                if ($size->getId() == $sizeId) {
                    $selectedSize = $size;
                    break;
                }
            }

            if ($selectedSize) {
                $_SESSION[$this->sessionKey][$key] = [
                    'id' => $sneaker->getId(),
                    'name' => $sneaker->getName(),
                    'price' => $sneaker->getPrice(),
                    'image' => $sneaker->getImage(),
                    'size' => [
                        'id' => $selectedSize->getId(),
                        'label' => $selectedSize->getSize() . ' US - ' . ucfirst(strtolower($selectedSize->getGender()))
                    ],
                    'quantity' => $quantity
                ];
            }
        }
    }

    /**
     * Elimina un producto del carrito por su clave
     *
     * @param string $key Clave del producto (generada por generateKey)
     * @return void
     */
    public function remove(string $key): void {
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }

    /**
     * Cambia la cantidad de un producto del carrito
     *
     * @param string $key Clave del producto
     * @param int $delta Diferencia a aplicar a la cantidad (puede ser negativa)
     * @return void
     */
    public function changeQuantity(string $key, int $delta): void
    {
        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $delta;

            if ($_SESSION['cart'][$key]['quantity'] <= 0) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    /**
     * Elimina todos los productos del carrito
     *
     * @return void
     */
    public function clear(): void
    {
        $_SESSION[$this->sessionKey] = [];
    }

    /**
     * Retorna los productos del carrito
     *
     * @return array
     */
    public function getItems(): array
    {
        return $_SESSION[$this->sessionKey] ?? [];
    }

    /**
     * Retorna la cantidad de ítems únicos en el carrito
     *
     * @return int
     */
    public function getCount(): int
    {
        return count($this->getItems());
    }

    /**
     * Retorna el precio total del carrito
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Genera una clave única basada en el ID del producto y el ID del talle
     *
     * @param int $sneakerId
     * @param int $sizeId
     * @return string
     */
    public function generateKey(int $sneakerId, int $sizeId): string
    {
        return "{$sneakerId}_{$sizeId}";
    }
}
