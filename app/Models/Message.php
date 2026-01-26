<?php

namespace App\Models;

class Message
{
    private ?int $id;
    private int $sender_id;
    private int $resever_id;
    private string $content;
    private ?string $sender_at;

    public function __construct(
        ?int $id = null,
        int $sender_id = 0,
        int $resever_id = 0,
        string $content = "",
        ?string $sender_at = null
    ) {
        $this->id = $id;
        $this->sender_id = $sender_id;
        $this->resever_id = $resever_id;
        $this->content = $content;
        $this->sender_at = $sender_at;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getSenderId(): int { return $this->sender_id; }
    public function getReseverId(): int { return $this->resever_id; }
    public function getContent(): string { return $this->content; }
    public function getSenderAt(): ?string { return $this->sender_at; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setSenderId(int $sender_id): void { $this->sender_id = $sender_id; }
    public function setReseverId(int $resever_id): void { $this->resever_id = $resever_id; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setSenderAt(?string $sender_at): void { $this->sender_at = $sender_at; }
}
