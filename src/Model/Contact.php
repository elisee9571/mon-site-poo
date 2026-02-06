<?php

namespace App\Model;

use DateTime;

class Contact
{
    private ?int $id = null;

    private string $email;

    private string $subject;

    private string $message;

    private string $created_at;

    private string $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Contact
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): Contact
    {
        $this->subject = $subject;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt(string $created_at): Contact
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return new DateTime($this->updated_at);
    }

    public function setUpdatedAt(string $updated_at): Contact
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
