<?php

class Cart
{
    private string $sessionKey = 'cart';

    public function __construct()
    {
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    /**
     * Agrega un producto al carrito.
     *
     * @param Sneaker $sneaker
     * @param int $sizeId
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

    public function remove(string $key): void {
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }

    public function changeQuantity(string $key, int $delta)
    {
        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $delta;

            if ($_SESSION['cart'][$key]['quantity'] <= 0) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    public function clear(): void
    {
        $_SESSION[$this->sessionKey] = [];
    }

    public function getItems(): array
    {
        return $_SESSION[$this->sessionKey] ?? [];
    }

    public function getCount(): int
    {
        return count($this->getItems());
    }

    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }


    public function generateKey(int $sneakerId, int $sizeId): string
    {
        return "{$sneakerId}_{$sizeId}";
    }
}
