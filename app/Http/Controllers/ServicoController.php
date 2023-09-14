<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;

class ServicoController extends Controller
{
    public function store(ServicoFormRequest $request){
        $servicos = Servico::create([
            'nome' => $request ->nome,
            'descricao' => $request ->descricao,
            'duracao' => $request ->duracao,
            'preco' => $request ->preco,

        ]); 
        return response()->json([
            "success" => true, 
            "message" => "Serviços cadastrado com sucesso",
            "data" => $servicos
        ], 200);
    }
   
    
    public function pesquisarPorNome(Request $request)
    {
        $servicos =  Servico::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($servicos) > 0) {

            return response()->json([
                'status' => true,
                'data' => $servicos
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function excluir($id)
    {
        $servicos = Servico::find($id);

        if (!isset($servicos)) {
            return response()->json([
                'status' => false,
                'message' => "Servico não encontrado"
            ]);
        }
        $servicos->delete();
        return response()->json([
            'status' => true,
            'message' => "servicos excluido com sucesso"
        ]);
    }

    public function update(Request $request)
    {
        $servicos = Servico::find($request->id);

        if (!isset($servicos)) {
            return response()->json([
                'status' => false,
                'message' => "servicos não encontrado"
            ]);
        }
        if (isset($request->descricao)) {
            $servicos->descricao = $request->descricao;
        }

        if (isset($request->nome)) {
            $servicos->nome = $request->nome;
        }

        if (isset($request->preco)) {
            $servicos->preco = $request->preco;
        }

        if (isset($request->duracao)) {
            $servicos->duracao = $request->duracao;
        }
        

        $servicos->update();

        return response()->json([
            'status' => true,
            'message' => "servicos atualizado"
        ]);
    }

    public function pesquisarPorDescricao(Request $request)
    {
        $servicos =  Servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();

        if (count($servicos) > 0) {

            return response()->json([
                'status' => true,
                'data' => $servicos
            ]);
        }
}
}