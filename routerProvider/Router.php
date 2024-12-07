<?php

namespace app\routerProvider;

use app\ApplicationException\ApplicationException;
use app\controller\CompressionController;
use app\controller\TextController;
use app\http\JsonResponse;
use app\http\Request;
use app\service\CompressionService;
use app\service\TextService;

class Router
{
    public const CONTROLLER_NAMESPACE = '';

    public function handle(Request $request)
    {
        $entityManager = getEntityManager();
        $act = $request->getQueryValue('model');
        $method = $request->getQueryValue('method');

        try {
            $controller = match ($act) {
                'cryptography' => new TextController(new TextService($entityManager)),
                'compression' => new CompressionController(new CompressionService($entityManager)),
                default => throw new ApplicationException('роут не найден', 404),
            };
            $result = $controller->$method($request);
            return new JsonResponse(200, ['success' => true, 'rows' => $result]);
        } catch (ApplicationException $exception) {
            return new JsonResponse($exception->getCode(), ['success' => false, 'message' => $exception->getMessage()]);
        } catch (\Throwable $throwable) {
//            var_dump($throwable);
            return new JsonResponse(500, ['success' => false, 'message' => 'Возникла ошибка при выполнении']);
        }
    }
}