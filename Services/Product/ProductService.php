<?php

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function decrementQuantity($id, $quantity)
    {
        $product = $this->productRepository->find($id);

        if ($product['quantity'] < $quantity) {
            throw new Exception("Not enough stock available");
        }

        return $this->productRepository->decrementQuantity($id, $quantity);
    }
}
