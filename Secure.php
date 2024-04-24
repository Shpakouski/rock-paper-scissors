<?php

namespace App;
require_once 'autoload.php';

class Secure
{
    private const int KEY_LENGTH = 32;
    private const string ALGO = 'sha3-256';
    private const string BEFORE_KEY = 'HMAC key: ';
    private const string BEFORE_HMAC = 'HMAC: ';
    private string $hash;
    private string $secureKey;
    private string $hmac;

    public function setSecureKey(): void
    {
        $this->secureKey = random_bytes(self::KEY_LENGTH);
    }

    public function getSecureKey(): string
    {
        return $this->secureKey;
    }

    public function setHash(): void
    {
        $this->hash = hash(self::ALGO, $this->getSecureKey());
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function printHash(): void
    {
        echo self::BEFORE_KEY . $this->getHash() . "\n";
    }

    public function setHmac(Computer $computer): void
    {
        $this->hmac = hash_hmac(self::ALGO, $computer->getMove(), $this->getHash());
    }

    public function getHmac(): string
    {
        return $this->hmac;
    }

    public function printHmac(): void
    {
        echo self::BEFORE_HMAC . $this->getHmac() . "\n";
    }
}
