<?php

namespace Hard2Code\Service;

use Hard2Code\Domain\ProductCartItem;

interface ProductCartService
{
    /**
     * @param  ProductCartItem  $productCartItem
     *
     * @return ProductCartItem
     */
    public function putProduct(ProductCartItem $productCartItem): ProductCartItem;

    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteProduct(int $id): bool;

    /**
     * @param  string|int  $identifier
     *
     * @return bool
     */
    public function clearCart(string|int $identifier): bool;

    /**
     * @param  ProductCartItem  $productCartItem
     *
     * @return ProductCartItem
     */
    public function updateProduct(ProductCartItem $productCartItem): ProductCartItem;

    /**
     * @return ProductCartItem[]
     */
    public function getProducts(): array;

    /**
     * @param  string|int  $identifier
     *
     * @return ProductCartItem[]
     */
    public function getCartByIdentifier(string|int $identifier): array;

    /**
     * Returns merged original product cart data with bitrix array data
     *
     * @param  string|int  $identifier
     *
     * @return array
     */
    public function getCartWitArrayResult(string|int $identifier): array;

    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @return int
     */
    public function getSize(): int;


}
