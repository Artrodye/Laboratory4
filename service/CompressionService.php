<?php

namespace app\service;

use app\ApplicationException\ApplicationException;
use app\CompressionLZ78\CompressionLZ78;
use app\dto\Compress\SafeCompressDTO;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;

readonly class CompressionService
{
    public function __construct(
        protected EntityManager $entityManager,
    )
    {
    }

    public function compressFile(SafeCompressDTO $dto): string
    {
        try {
            return (new CompressionLZ78())->compressText($dto->stroka);
        } catch (ApplicationException $applicationException) {
            throw $applicationException;
        } catch (ORMException $ORMException) {
            throw new ApplicationException("Возникла ошибка при выполнении", 500);
        }
    }

    public function decompressFile(SafeCompressDTO $dto): string
    {
        try {
            return (new CompressionLZ78())->decompressText($dto->stroka);
        } catch (ApplicationException $applicationException) {
            throw $applicationException;
        } catch (ORMException $ORMException) {
            throw new ApplicationException("Возникла ошибка при выполнении", 500);
        }
    }
}
