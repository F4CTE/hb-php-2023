<?php

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    //getters and setters
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}