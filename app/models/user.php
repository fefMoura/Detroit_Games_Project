<?php

namespace App\Models;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $address;
    private string $phone;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(
        int $id = 0,
        string $name = '',
        string $email = '',
        string $password = '',
        string $address = '',
        string $phone = '',
        string $createdAt = '',
        string $updatedAt = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phone = $phone;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters and setters
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): void { $this->password = $password; }

    public function getAddress(): string { return $this->address; }
    public function setAddress(string $address): void { $this->address = $address; }

    public function getPhone(): string { return $this->phone; }
    public function setPhone(string $phone): void { $this->phone = $phone; }

    public function getCreatedAt(): string { return $this->createdAt; }
    public function setCreatedAt(string $createdAt): void { $this->createdAt = $createdAt; }

    public function getUpdatedAt(): string { return $this->updatedAt; }
    public function setUpdatedAt(string $updatedAt): void { $this->updatedAt = $updatedAt; }
}