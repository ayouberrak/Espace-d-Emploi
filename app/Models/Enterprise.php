<?php

namespace App\Models;

class Enterprise
{
    private ?int $id;
    private string $nom;
    private ?string $logo;
    private string $description;
    private string $location;
    private int $recruiter_id;
    private ?string $create_at;

    public function __construct(
        ?int $id = null,
        string $nom = "",
        ?string $logo = null,
        string $description = "",
        string $location = "",
        int $recruiter_id = 0,
        ?string $create_at = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->logo = $logo;
        $this->description = $description;
        $this->location = $location;
        $this->recruiter_id = $recruiter_id;
        $this->create_at = $create_at;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getLogo(): ?string { return $this->logo; }
    public function getDescription(): string { return $this->description; }
    public function getLocation(): string { return $this->location; }
    public function getRecruiterId(): int { return $this->recruiter_id; }
    public function getCreateAt(): ?string { return $this->create_at; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setLogo(?string $logo): void { $this->logo = $logo; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setLocation(string $location): void { $this->location = $location; }
    public function setRecruiterId(int $recruiter_id): void { $this->recruiter_id = $recruiter_id; }
    public function setCreateAt(?string $create_at): void { $this->create_at = $create_at; }
}
