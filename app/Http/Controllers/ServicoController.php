<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Str;
use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\ServicoUpdateFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function criarServico(ServicoFormRequest $request){
        $servico = Servico ::create([
            'nome' => $request ->nome,
            'descricao' => $request ->descricao,
            'duracao' => $request ->duracao,
            'preco' => str_replace(',', '.', $request->preco)

        ]); 
        return response()->json([
            "success" => true, 
            "message" => "Serviços cadastrado com sucesso",
            "data" => $servico
        ], 200);
    }

    public function pesquisarPorId($id)
    {
        $servico = Servico ::find($id);
        if ($servico == null) {
            return response()->json([
                'status' => false,
                'message' => "servico não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $servico
        ]);
    }
   
    public function retornarTodos()
    {
        $servicos = Servico::all();
        return response()->json([
            'status' => true,
            'data' => $servicos
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $servico =  Servico::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($servico) > 0) {
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function excluirServico($id)
    {
        $servico = Servico::find($id);
        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Servico não encontrado"
            ]);
        }
        $servico->delete();
        return response()->json([
            'status' => true,
            'message' => "servicos excluido com sucesso"
        ]);
    }

    public function atualizarServico(ServicoUpdateFormRequest $request)
    {
        $servico = Servico::find($request->id);

        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não atualizado"
            ]);
        }
        if (isset($request->descricao)) {
            $servico->descricao = $request->descricao;
        }

        if (isset($request->nome)) {
            $servico->nome = $request->nome;
        }

        if (isset($request->preco)) {
            $servico->preco = $request->preco;
        }

        if (isset($request->duracao)) {
            $servico->duracao = $request->duracao;
        }
        
        $servico->update();

        return response()->json([
            'status' => true,
            'message' => "Serviço atualizado"
        ]);
    }

    public function pesquisarPorDescricao(Request $request)
    {
        $servico =  Servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();

        if (count($servico) > 0) {

            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Servico não encontrado"
        ]);
}
}