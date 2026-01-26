<?php

namespace App\Models;

class Invitation
{
    private ?int $id;
    private int $sender_id;
    private int $resever_id;
    private string $status;
    private ?string $created_at;

    public function __construct(
        ?int $id = null,
        int $sender_id = 0,
        int $resever_id = 0,
        string $status = "pending",
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->sender_id = $sender_id;
        $this->resever_id = $resever_id;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getSenderId(): int { return $this->sender_id; }
    public function getReseverId(): int { return $this->resever_id; }
    public function getStatus(): string { return $this->status; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setSenderId(int $sender_id): void { $this->sender_id = $sender_id; }
    public function setReseverId(int $resever_id): void { $this->resever_id = $resever_id; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
}
