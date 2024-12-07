<?php

namespace app\controller;

use app\Container\Container;
use app\dto\Compress\SafeCompressDTO;
use app\http\Request;
use app\service\CompressionService;

readonly class CompressionController
{
    public function __construct(
        private CompressionService $compressionService,
    )
    {
    }

    public function compressFile(Request $request): string
    {
        $dto = (new Container())->get(SafeCompressDTO::class);
        $file = file_get_contents($request->getBodyValue('File')['tmp_name']);
        $dto->stroka = strtoupper($file);
        $compressedText = $this->compressionService->compressFile($dto);
//        file_put_contents('response.json', json_encode($compressedText));
//        readfile('response.json');
        return $this->compressionService->compressFile($dto);
    }

    public function decompressFile(Request $request): string
    {
        $dto = (new Container())->get(SafeCompressDTO::class);
        $file = file_get_contents($request->getBodyValue('File')['tmp_name']);
        $dto->stroka = strtoupper($file);
        return $this->compressionService->decompressFile($dto);
    }
}