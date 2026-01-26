<?php

namespace App\Models;

class Notification
{
    private ?int $id;
    private int $user_id;
    private string $type;
    private array $data;
    private ?string $read_at;
    private ?string $created_at;

    public function __construct(
        ?int $id = null,
        int $user_id = 0,
        string $type = "",
        array $data = [],
        ?string $read_at = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->data = $data;
        $this->read_at = $read_at;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->user_id; }
    public function getType(): string { return $this->type; }
    public function getData(): array { return $this->data; }
    public function getReadAt(): ?string { return $this->read_at; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setType(string $type): void { $this->type = $type; }
    public function setData(array $data): void { $this->data = $data; }
    public function setReadAt(?string $read_at): void { $this->read_at = $read_at; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
}
