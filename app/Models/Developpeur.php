<?php

namespace App\Models;

class Developpeur extends User
{
    private ?array $amis;

    public function __construct(
        ?int $id = null,
        string $name = "",
        string $email = "",
        string $password = "",
        string $role = "devloppeur",
        ?string $photo = null,
        ?string $bio = null,
        ?string $phone = null,
        ?array $amis = null,
        ?string $created_at = null,
        ?string $updated_at = null
    ) {
        parent::__construct($id, $name, $email, $password, $role, $photo, $bio, $phone, $created_at, $updated_at);
        $this->amis = $amis;
    }

    public function getAmis(): ?array { return $this->amis; }
    public function setAmis(?array $amis): void { $this->amis = $amis; }
}
