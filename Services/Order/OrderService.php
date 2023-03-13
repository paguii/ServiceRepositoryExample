<?php

class OrderService
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function checkout(array $items)
    {
        // Validação dos itens do pedido
        foreach ($items as $item) {
            $product = $this->productService->find($item['product_id']);

            if ($product['price'] != $item['price']) {
                throw new Exception("Price of item does not match product price");
            }

            $this->productService->decrementQuantity($item['product_id'], $item['quantity']);
        }

        // Lógica de pagamento, envio de email, etc.
        // ...

        return true;
    }
}
