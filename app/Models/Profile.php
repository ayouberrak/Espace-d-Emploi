<?php

namespace App\Models;

class Profile
{
    private ?int $id;
    private int $user_id;
    private string $title;
    private string $bio;
    private ?array $skills;
    private ?array $experiances;
    private ?array $projects;

    public function __construct(
        ?int $id = null,
        int $user_id = 0,
        string $title = "",
        string $bio = "",
        ?array $skills = null,
        ?array $experiances = null,
        ?array $projects = null
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->bio = $bio;
        $this->skills = $skills;
        $this->experiances = $experiances;
        $this->projects = $projects;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->user_id; }
    public function getTitle(): string { return $this->title; }
    public function getBio(): string { return $this->bio; }
    public function getSkills(): ?array { return $this->skills; }
    public function getExperiances(): ?array { return $this->experiances; }
    public function getProjects(): ?array { return $this->projects; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function setBio(string $bio): void { $this->bio = $bio; }
    public function setSkills(?array $skills): void { $this->skills = $skills; }
    public function setExperiances(?array $experiances): void { $this->experiances = $experiances; }
    public function setProjects(?array $projects): void { $this->projects = $projects; }
}
