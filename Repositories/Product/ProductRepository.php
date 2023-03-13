<?php

class ProductRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = :name, price = :price, quantity = :quantity WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $data['name'], 'price' => $data['price'], 'quantity' => $data['quantity']]);
        return $this->find($id);
    }

    public function decrementQuantity($id, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE products SET quantity = quantity - :quantity WHERE id = :id");
        $stmt->execute(['id' => $id, 'quantity' => $quantity]);
        return $this->find($id);
    }
}
