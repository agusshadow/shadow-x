<?php

class Order {
    private int $id;
    private ?int $user_id;
    private string $full_name;
    private string $phone;
    private string $city;
    private string $postal_code;
    private string $shipping_address;
    private string $payment_method;
    private float $total_amount;
    private string $status;
    private string $created_at;
    private string $updated_at;

    private array $items = []; // productos asociados a la orden

    // ======= CREATE =======
    public static function create(array $data, array $items): int {
        $conexion = DbConnection::getConexion();

        try {
            $conexion->beginTransaction();

            $sqlOrder = "INSERT INTO orders (user_id, full_name, phone, city, postal_code, shipping_address, payment_method, total_amount, status, created_at, updated_at)
                         VALUES (:user_id, :full_name, :phone, :city, :postal_code, :shipping_address, :payment_method, :total_amount, 'pending', NOW(), NOW())";
            $stmtOrder = $conexion->prepare($sqlOrder);
            $stmtOrder->execute([
                'user_id'         => $data['user_id'],
                'full_name'       => $data['full_name'],
                'phone'           => $data['phone'],
                'city'            => $data['city'],
                'postal_code'     => $data['postal_code'],
                'shipping_address'=> $data['shipping_address'],
                'payment_method'  => $data['payment_method'],
                'total_amount'    => $data['total_amount']
            ]);

            $orderId = (int)$conexion->lastInsertId();

            $sqlItem = "INSERT INTO order_sneakers (order_id, sneaker_id, size_id, price, quantity)
                        VALUES (:order_id, :sneaker_id, :size_id, :price, :quantity)";
            $stmtItem = $conexion->prepare($sqlItem);

            foreach ($items as $item) {
                $stmtItem->execute([
                    'order_id'   => $orderId,
                    'sneaker_id' => $item['id'],
                    'size_id'    => $item['size']['id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity']
                ]);
            }

            $conexion->commit();
            return $orderId;

        } catch (PDOException $e) {
            if ($conexion->inTransaction()) {
                $conexion->rollBack();
            }
            error_log("Error al crear la orden: " . $e->getMessage());
            throw $e;
        }
    }

    // ======= GET BY ID =======
    public static function getById(int $id): ?Order {
        $conexion = DbConnection::getConexion();

        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$orderData) {
            return null;
        }

        $order = new self();
        $order->id = (int)$orderData['id'];
        $order->user_id = $orderData['user_id'] !== null ? (int)$orderData['user_id'] : null;
        $order->full_name = $orderData['full_name'];
        $order->phone = $orderData['phone'];
        $order->city = $orderData['city'];
        $order->postal_code = $orderData['postal_code'];
        $order->shipping_address = $orderData['shipping_address'];
        $order->payment_method = $orderData['payment_method'];
        $order->total_amount = (float)$orderData['total_amount'];
        $order->status = $orderData['status'];
        $order->created_at = $orderData['created_at'];
        $order->updated_at = $orderData['updated_at'];

        $sqlItems = "SELECT os.*, s.name AS sneaker_name, sz.size AS size_label, sz.gender
                     FROM order_sneakers os
                     JOIN sneakers s ON os.sneaker_id = s.id
                     JOIN sizes sz ON os.size_id = sz.id
                     WHERE os.order_id = ?";
        $stmtItems = $conexion->prepare($sqlItems);
        $stmtItems->execute([$id]);
        $order->items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

        return $order;
    }

        // ======= GET BY USER ID =======
    public static function getByUserId(int $userId): array
    {
        $conexion = DbConnection::getConexion();

        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$userId]);
        $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($ordersData as $orderData) {
            $order = new self();
            $order->id = (int)$orderData['id'];
            $order->user_id = $orderData['user_id'] !== null ? (int)$orderData['user_id'] : null;
            $order->full_name = $orderData['full_name'];
            $order->phone = $orderData['phone'];
            $order->city = $orderData['city'];
            $order->postal_code = $orderData['postal_code'];
            $order->shipping_address = $orderData['shipping_address'];
            $order->payment_method = $orderData['payment_method'];
            $order->total_amount = (float)$orderData['total_amount'];
            $order->status = $orderData['status'];
            $order->created_at = $orderData['created_at'];
            $order->updated_at = $orderData['updated_at'];

            $sqlItems = "SELECT os.*, s.name AS sneaker_name, sz.size AS size_label, sz.gender
                         FROM order_sneakers os
                         JOIN sneakers s ON os.sneaker_id = s.id
                         JOIN sizes sz ON os.size_id = sz.id
                         WHERE os.order_id = ?";
            $stmtItems = $conexion->prepare($sqlItems);
            $stmtItems->execute([$order->id]);
            $order->items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

            $orders[] = $order;
        }

        return $orders;
    }

    // ======= GET ALL ORDERS =======
    public static function getAll(): array
    {
        $conexion = DbConnection::getConexion();

        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $conexion->query($sql);
        $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($ordersData as $orderData) {
            $order = new self();
            $order->id = (int)$orderData['id'];
            $order->user_id = $orderData['user_id'] !== null ? (int)$orderData['user_id'] : null;
            $order->full_name = $orderData['full_name'];
            $order->phone = $orderData['phone'];
            $order->city = $orderData['city'];
            $order->postal_code = $orderData['postal_code'];
            $order->shipping_address = $orderData['shipping_address'];
            $order->payment_method = $orderData['payment_method'];
            $order->total_amount = (float)$orderData['total_amount'];
            $order->status = $orderData['status'];
            $order->created_at = $orderData['created_at'];
            $order->updated_at = $orderData['updated_at'];

            $sqlItems = "SELECT os.*, s.name AS sneaker_name, sz.size AS size_label, sz.gender
                         FROM order_sneakers os
                         JOIN sneakers s ON os.sneaker_id = s.id
                         JOIN sizes sz ON os.size_id = sz.id
                         WHERE os.order_id = ?";
            $stmtItems = $conexion->prepare($sqlItems);
            $stmtItems->execute([$order->id]);
            $order->items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

            $orders[] = $order;
        }

        return $orders;
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $conexion = DbConnection::getConexion();

        $allowedStatuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }

        try {
            $sql = "UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                'status' => $status,
                'id'     => $id
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar estado de la orden: " . $e->getMessage());
            return false;
        }
    }

    // ======= Getters (puedes expandir según necesites) =======
    public function getId(): int {
        return $this->id;
    }

    public function getFullName(): string {
        return $this->full_name;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getPostalCode(): string {
        return $this->postal_code;
    }

    public function getShippingAddress(): string {
        return $this->shipping_address;
    }

    public function getPaymentMethod(): string {
        return $this->payment_method;
    }

    public function getTotalAmount(): float {
        return $this->total_amount;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function getUpdatedAt(): string {
        return $this->updated_at;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getUserId(): ?int {
        return $this->user_id;
    }
}
