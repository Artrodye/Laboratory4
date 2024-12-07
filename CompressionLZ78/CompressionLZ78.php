<?php

namespace app\CompressionLZ78;

class CompressionLZ78
{
    private array $dictionary = [''];
    private string $compressText = '';
    private string $decompressText = '';
    public function compressText (string $compressText) {
        $stroka = '';
        foreach (str_split($compressText) as $char) {
            if (!in_array($stroka . $char, $this->dictionary)) {
                $this->dictionary[] = $stroka . $char;
                $this->compressText .= array_search($stroka, $this->dictionary) . $char;
                $stroka = '';
            } else {
                $stroka .= $char;
            }
        }
        if (!($stroka == '')) {
            $this->compressText .= array_search(substr($stroka, 0, strlen($stroka) - 1), $this->dictionary) . $char;
        }
        return $this->compressText;
    }

    public function decompressText (string $decompressText)
    {
        $alphabet = 'АABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chislo = '';
        $stroka = '';
        foreach (str_split($decompressText) as $char) {
            if (!strpos($alphabet, $char)) {
                $chislo .= $char;
            } else {
                $this->decompressText .= $this->dictionary[(int) $chislo] . $char;
                $this->dictionary[] = $this->dictionary[(int) $chislo] . $char;
                $chislo = '';
            }
        }
        return $this->decompressText;
    }
}