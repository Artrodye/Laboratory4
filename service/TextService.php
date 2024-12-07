<?php

namespace app\service;

use app\ApplicationException\ApplicationException;
use app\dto\Text\SafeTextDTO;
use app\entity\TextEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use app\DiffiHellMan\DiffiHellMan;

readonly class TextService
{
    public function __construct(
        protected EntityManager $entityManager,
    )
    {
    }

    public function getAll(): array
    {
        $texts = $this->entityManager->getRepository(TextEntity::class)->findAll();
        $result = [];
        foreach ($texts as $text) {
            $shifrator = new DiffiHellMan($text->getOpenKey());
            $result[] = [
                "id" => $text->getId(),
                "cryptText" => $text->getText(),
                "decryptText" => $shifrator->decryptDiffie($text->getText(), $text->getOpenKey(), $text->getB())
            ];
        }
        return $result;
    }

    public function cryptText(SafeTextDTO $dto): string
    {
        try {
            $text = new TextEntity();
            $shifrator = new DiffiHellMan($dto->openKey);
            $a = $shifrator->cryptDiffie($dto->text);
            $text->setText($a);
            $text->setOpenKey($dto->openKey);
            $text->setB($shifrator->getB());
            $this->entityManager->persist($text);
            $this->entityManager->flush();
            return $text->getText();
        } catch (ApplicationException $applicationException) {
            throw $applicationException;
        } catch (ORMException $ORMException) {
            throw new ApplicationException("Возникла ошибка при выполнении", 500);
        }
    }

    public function decryptText(SafeTextDTO $dto): string
    {
        try {
            $text = new TextEntity();
            $shifrator = new DiffiHellMan($dto->openKey);
            return $shifrator->decryptDiffie($dto->text, $dto->openKey, $dto->b);
        } catch (ApplicationException $applicationException) {
            throw $applicationException;
        } catch (ORMException $ORMException) {
            throw new ApplicationException("Возникла ошибка при выполнении", 500);
        }
    }
}
