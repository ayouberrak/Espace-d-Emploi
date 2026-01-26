<?php

namespace App\Models;

abstract class User
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private ?string $photo;
    private ?string $bio;
    private ?string $phone;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct( ?int $id = null, string $name = "", string $email = "", string $password = "", string $role = "", ?string $photo = null, ?string $bio = null, ?string $phone = null, ?string $created_at = null, ?string $updated_at = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->photo = $photo;
        $this->bio = $bio;
        $this->phone = $phone;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getBio(): ?string { return $this->bio; }
    public function getPhone(): ?string { return $this->phone; }
    public function getCreatedAt(): ?string { return $this->created_at; }
    public function getUpdatedAt(): ?string { return $this->updated_at; }

    public function setId(?int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setRole(string $role): void { $this->role = $role; }
    public function setPhoto(?string $photo): void { $this->photo = $photo; }
    public function setBio(?string $bio): void { $this->bio = $bio; }
    public function setPhone(?string $phone): void { $this->phone = $phone; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
    public function setUpdatedAt(?string $updated_at): void { $this->updated_at = $updated_at; }
}
