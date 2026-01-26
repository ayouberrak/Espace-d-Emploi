<?php

namespace App\Models;

class Recruteur extends User
{
    public function __construct(
        ?int $id = null,
        string $name = "",
        string $email = "",
        string $password = "",
        string $role = "recruiter",
        ?string $photo = null,
        ?string $bio = null,
        ?string $phone = null,
        ?string $created_at = null,
        ?string $updated_at = null
    ) {
        parent::__construct($id, $name, $email, $password, $role, $photo, $bio, $phone, $created_at, $updated_at);
    }
}
