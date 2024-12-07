<?php

namespace app\DiffiHellMan;

use app\Secret\Secret;

class DiffiHellMan
{
    private int $secretKey;
    private int $openKey;
    private int $b;
    private int $p;
    public function __construct ($openKey)
    {
        $this->openKey = $openKey;
        $array = Secret::getSecret();
        $this->p = $array['p'];
        $this->b = $array['b'];
        $this->secretKey = ($openKey ^ $this->b) % $this->p;
    }
    public function cryptDiffie(string $text): string
    {
        return base64_encode($text . $this->secretKey);
    }

    public function decryptDiffie(string $text, int $openKey, int $b): string
    {
        $decode = base64_decode($text);
        return substr($decode, 0, strlen($decode) - strlen(strval(($openKey ^ $b) % $this->p)));
    }

    public function getB(): int
    {
        return $this->b;
    }
}