<?php

namespace App\Models;

class Offer
{
    private ?int $id;
    private int $enptrise_id;
    private int $recruiter_id;
    private string $title;
    private string $description;
    private string $ofres_type;
    private string $durre;
    private ?string $created_at;

    public function __construct(
        ?int $id = null,
        int $enptrise_id = 0,
        int $recruiter_id = 0,
        string $title = "",
        string $description = "",
        string $ofres_type = "",
        string $durre = "",
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->enptrise_id = $enptrise_id;
        $this->recruiter_id = $recruiter_id;
        $this->title = $title;
        $this->description = $description;
        $this->ofres_type = $ofres_type;
        $this->durre = $durre;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getEnptriseId(): int { return $this->enptrise_id; }
    public function getRecruiterId(): int { return $this->recruiter_id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getOfresType(): string { return $this->ofres_type; }
    public function getDurre(): string { return $this->durre; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setEnptriseId(int $enptrise_id): void { $this->enptrise_id = $enptrise_id; }
    public function setRecruiterId(int $recruiter_id): void { $this->recruiter_id = $recruiter_id; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setOfresType(string $ofres_type): void { $this->ofres_type = $ofres_type; }
    public function setDurre(string $durre): void { $this->durre = $durre; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
}
