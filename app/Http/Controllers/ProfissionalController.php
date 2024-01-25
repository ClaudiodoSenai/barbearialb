<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormRequest;
use App\Http\Requests\ProfissionalUpdateFormRequest;
use App\Models\Profissional;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalController extends Controller
{
    public function criarProfissional(ProfissionalFormRequest $request)
    {
        $profissional = Profissional::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'senha' => Hash::make($request->senha),
            'salario' => $request->salario

        ]);
        return response()->json([
            "success" => true,
            "message" => "profissional cadastrado com sucesso",
            "data" => $profissional
        ], 200);
    }

    public function pesquisarPorId($id)
    {
        $profissional = Profissional::find($id);
        if ($profissional == null) {
            return response()->json([
                'status' => false,
                'message' => "profissional não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $profissional
        ]);
    }

    public function retornarTodos()
    {
        $profissionais = Profissional::all();
        return response()->json([
            'status' => true,
            'data' => $profissionais
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $profissional = Profissional::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($profissional) > 0) {

            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function excluirProfissional(Request $request)
    {

        $profissional = Profissional::find($request->id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "profissional não encontrado"
            ]);
        }
        if ($agendamento = Agenda::where('profissional_id', $request->id)->get()) {
            if (count($agendamento) > 0) {
                return response()->json([
                    'status' => false,
                    'message' => "Não foi possível excluir, pois o profissional possui agendamentos registrados."
                ]);
            }
        }
        $profissional->delete();
        return response()->json([
            'status' => true,
            'message' => "profissional excluido com sucesso"
        ]);
    }

    public function atualizarProfissional(ProfissionalUpdateFormRequest $request)
    {
        $profissional = Profissional::find($request->id);
        //Função If set para verificar se a variavel está vazia ou com um valor determinado
        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "profissional não atualizado"
            ]);
        }
        if (isset($request->celular)) {
            $profissional->celular = $request->celular;
        }

        if (isset($request->nome)) {
            $profissional->nome = $request->nome;
        }

        if (isset($request->email)) {
            $profissional->email = $request->email;
        }

        if (isset($request->cpf)) {
            $profissional->cpf = $request->cpf;
        }

        if (isset($request->dataNascimento)) {
            $profissional->dataNascimento = $request->dataNascimento;
        }

        if (isset($request->cidade)) {
            $profissional->cidade = $request->cidade;
        }

        if (isset($request->estado)) {
            $profissional->estado = $request->estado;
        }

        if (isset($request->pais)) {
            $profissional->pais = $request->pais;
        }

        if (isset($request->rua)) {
            $profissional->rua = $request->rua;
        }

        if (isset($request->numero)) {
            $profissional->numero = $request->numero;
        }

        if (isset($request->bairro)) {
            $profissional->bairro = $request->bairro;
        }

        if (isset($request->cep)) {
            $profissional->cep = $request->cep;
        }

        if (isset($request->complemento)) {
            $profissional->complemento = $request->complemento;
        }

        if (isset($request->senha)) {
            $profissional->senha = $request->senha;
        }

        if (isset($request->salario)) {
            $profissional->salario = $request->salario;
        }

        $profissional->update();

        return response()->json([
            'status' => true,
            'message' => "profissional atualizados"
        ]);
    }

    public function pesquisarPorCpf(Request $request)
    {
        $profissional = Profissional::where('cpf', 'like', '%' . $request->cpf . '%')->get();
        if (count($profissional) > 0) {

            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorTelefone(Request $request)
    {
        $profissional = Profissional::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($profissional) > 0) {

            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorEmail(Request $request)
    {
        $profissional = Profissional::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($profissional) > 0) {

            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function esqueciMinhaSenha(Request $request)
    {
       $profissional = Profissional::where('email', 'LIKE', $request->email)->first();
       if ($profissional) {
           $novaSenha = $profissional->cpf;
           $profissional->update([
               'senha' => //Hash::make
               ($novaSenha),
               'updated_at' => now()
           ]);
           return response()->json([        
               'status' => true,
               'message' => 'Senha redefinida',
               'nova_senha' => Hash::make($novaSenha)
           ]);
       } else {
           return response()->json([
               'status' => false,
               'message' => 'Profissional não encontrado'
           ]);
       }
    }
}

