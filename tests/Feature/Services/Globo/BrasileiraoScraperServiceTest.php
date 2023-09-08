<?php

namespace Tests\Feature\Services\Globo;

use App\Services\Globo\BrasileiraoScraperService;
use Tests\TestCase;

// sail artisan test --filter=BrasileiraoScraperServiceTest
class BrasileiraoScraperServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_classificacao_serie_a(): void
    {
        $conteudo = BrasileiraoScraperService::classificacaoSerieA();
        $this->assertNotEmpty($conteudo);
        $this->assertNotEmpty($conteudo[0]);
        $this->assertNotEmpty($conteudo[0]['aproveitamento']);
        $this->assertNotEmpty($conteudo[0]['faixa_classificacao']['cor']);
    }
}
