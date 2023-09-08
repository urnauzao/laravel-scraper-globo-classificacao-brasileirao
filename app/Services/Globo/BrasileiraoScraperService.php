<?php

declare (strict_types = 1);

namespace App\Services\Globo;

use App\Repositories\Globo\BrasileiraoRepository;

class BrasileiraoScraperService
{
    public static function classificacaoSerieA(): array
    {
        $resultado = BrasileiraoRepository::getBrasileiraoSerieA();
        if ($resultado->failed()) {
            logs()->debug("Falha ao fazer a consulta à repository.", ['status' => $resultado->status(), 'msg' => $resultado->json()]);
            return [];
        }

        $conteudo = $resultado->body();
        if (empty($conteudo)) {
            logs()->debug("Conteúdo obtido ao fazer a consulta está vazio.", ['status' => $resultado->status(), 'msg' => $resultado->json()]);
            return [];
        }

        $busca = '<script type="text/javascript" id="scriptReact">';
        if (!str($conteudo)->contains($busca, true)) {
            logs()->debug('O script que está sendo buscado não foi encontrado na página.', ['status' => $resultado->status(), 'msg' => $conteudo]);
            return [];
        }

        $script = str($conteudo)->betweenFirst($busca, "</script>")->value();
        unset($conteudo);
        $busca_inicio_classificacao = "const classificacao = {";
        $busca_final_classificacao = "};";
        $classificacao = str($script)->betweenFirst($busca_inicio_classificacao, $busca_final_classificacao)->value();
        $classificacao = "{{$classificacao}}"; // ajusta para ser um json, pois as chaves({}) haviam sido removidas pelo between
        $json = json_decode($classificacao, true); //este true faz tudo se tornar em array associativos
        if (empty($json)) {
            logs()->debug('Não foi possível decodar o json.', ['status' => $resultado->status(), 'msg' => $classificacao]);
            return [];
        }

        $chave = 'classificacao';
        if (empty($json[$chave])) {
            logs()->debug("Não foi possível encontrar a chave {$chave} no json obtido.", ['status' => $resultado->status(), 'msg' => $json]);
            return [];
        }

        logs()->info("Foi obtido com sucesso a classificação do brasileirão série A.", []);
        return $json[$chave];
    }
}
