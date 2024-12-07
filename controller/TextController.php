<?php

namespace app\controller;

use app\Container\Container;
use app\dto\Text\SafeTextDTO;
use app\http\Request;
use app\service\TextService;

readonly class TextController
{
    public function __construct(
        private TextService $textService,
    )
    {
    }
    public function getAll(Request $request): array
    {
        return $texts = $this->textService->getAll();
    }

    public function cryptText(Request $request): string
    {
        $dto = (new Container())->get(SafeTextDTO::class);
        $dto->text = $request->getBodyValue('text');
        $dto->openKey = $request->getBodyValue('openKey');
        return $this->textService->cryptText($dto);
    }

    public function decryptText(Request $request): string
    {
        $dto = (new Container())->get(SafeTextDTO::class);
        $dto->text = $request->getBodyValue('text');
        $dto->openKey = $request->getBodyValue('openKey');
        $dto->b = $request->getBodyValue('b');
        return $this->textService->decryptText($dto);
    }
}