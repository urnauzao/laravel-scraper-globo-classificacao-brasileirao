<?php

namespace App\Http\Controllers\Api\Globo\Brasileirao;

use App\Http\Controllers\Controller;
use App\Services\Globo\BrasileiraoScraperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrasileiraoSerieAController extends Controller
{
    public function getClassificacao(): JsonResponse
    {
        $resultado = BrasileiraoScraperService::classificacaoSerieA();
        if (empty($resultado)) {
            return response()->json(['msg' => 'Não foi possível obter a tabela de classificação do brasileirão série A.'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($resultado, Response::HTTP_OK);
    }
}
