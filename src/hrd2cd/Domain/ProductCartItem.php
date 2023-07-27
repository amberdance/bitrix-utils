<?php

namespace Hard2Code\Domain;

use JsonSerializable;
use TypeError;

class ProductCartItem implements JsonSerializable {
    private int $productId;
    private string $sessionId;
    private int $count;
    private ?int $id = null;


    /**
     * @param  int     $productId
     * @param  string  $sessionId
     * @param  int     $count
     */
    public function __construct(int $productId, string $sessionId, int $count) {
        if ($productId == 0) {
            throw new TypeError("Product id must be a positive integer");
        }

        $this->productId = $productId;
        $this->sessionId = $sessionId;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getProductId(): int {
        return $this->productId;
    }

    /**
     * @param  int  $productId
     */
    public function setProductId(int $productId): void {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getSessionId(): string {
        return $this->sessionId;
    }

    /**
     * @param  string  $sessionId
     */
    public function setSessionId(string $sessionId): void {
        $this->sessionId = $sessionId;
    }

    /**
     * @return int
     */
    public function getCount(): int {
        return $this->count;
    }

    /**
     * @param  int  $count
     */
    public function setCount(int $count): void {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param  int  $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array {
        return [
                "id"         => $this->id,
                "session_id" => $this->sessionId,
                "product_id" => $this->productId,
                "count"      => $this->count,
        ];
    }
}
