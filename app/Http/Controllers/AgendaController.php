<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Http\Requests\AgendaUpdateFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function criarHorarioProfissional(AgendaFormRequest $request)
    {

        $agendaProfissional =Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();

        if (count($agendaProfissional) > 0){ 
            return response()->json([
                "success" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agendaProfissional
            ], 200);
        } else{

            $agendaProfissional = Agenda::create([
                'profissional_id' => $request->profissional_id,
                'data_hora' => $request->data_hora
            ]);
            return response()->json([
                "success" => true,
                "message" => "Agendado com sucesso",
                "data" => $agendaProfissional
            ], 200);
        } 
   
    }
    public function retornarTodos()
    {
        $agendamentos = Agenda::all();
        return response()->json([
            'status' => true,
            'data' => $agendamentos
        ]);
    }

    public function excluirHorario($id)
    {
        $agendamento = Agenda::find($id);

        if (!isset($agendamento)) {
            return response()->json([
                'status' => false,
                'message' => "agendamento não encontrado"
            ]);
        }
        $agendamento->delete();
        return response()->json([
            'status' => true,
            'message' => "agendamento excluido com sucesso"
        ]);
    }

    public function updateHorarios(AgendaUpdateFormRequest $request)
    {
        $profissionalHorario = Agenda::find($request->id);

        if (!isset($profissionalHorario)) {
            return response()->json([
                'status' => false,
                'message' => "Horario não atualizados"
            ]);
        }
        
        if (isset($request->profissional_id)) {
            $profissionalHorario->profissional_id = $request->profissional_id;
        }

        if (isset($request->data_hora)) {
            $profissionalHorario->data_hora = $request->data_hora;
        }

        if (isset($request->cliente_id)) {
            $profissionalHorario->cliente_id = $request->cliente_id;
        }

        if (isset($request->servico_id)) {
            $profissionalHorario->servico_id = $request->servico_id;
        }

        if (isset($request->tipoPagamento)) {
            $profissionalHorario->tipoPagamento = $request->tipoPagamento;
        }

        if (isset($request->valor)) {
            $profissionalHorario->valor = $request->valor;
        }


       

        $profissionalHorario->update();

        return response()->json([
            'status' => true,
            'message' => "Horarios atualizados"
        ]);
    }
}