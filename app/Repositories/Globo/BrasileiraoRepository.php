<?php

declare (strict_types = 1);

namespace App\Repositories\Globo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BrasileiraoRepository
{
    public static function getBrasileiraoSerieA(): Response
    {
        return Http::get('https://ge.globo.com/futebol/brasileirao-serie-a/');
    }
}
