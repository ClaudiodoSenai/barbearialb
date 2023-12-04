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

        $agendaProfissional = Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();

        if (count($agendaProfissional) > 0) {
            return response()->json([
                "success" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agendaProfissional
            ], 200);
        } else {

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
        $agendaProfissional = Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();

        if (count($agendaProfissional) > 0) {
            return response()->json([
                "status" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agendaProfissional
            ], 200);
        } else {

            $agenda = Agenda::find($request->id);

            if (!isset($agenda)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Não há resultados para horários'
                ]);
            }
            if (isset($request->profissional_id)) {
                $agenda->profissional_id = $request->profissional_id;
            }
            if (isset($request->cliente_id)) {
                $agenda->cliente_id = $request->cliente_id;
            }
            if (isset($request->servico_id)) {
                $agenda->servico_id = $request->servico_id;
            }
            if (isset($request->data_hora)) {
                $agenda->data_hora = $request->data_hora;
            }
            if (isset($request->tipoPagamento)) {
                $agenda->tipoPagamento = $request->tipoPagamento;
            }
            if (isset($request->valor)) {
                $agenda->valor = $request->valor;
            }
            $agenda->update();
            return response()->json([
                'status' => true,
                'message' => 'Agenda atualizada com sucesso'
            ]);
        }
    }

    public function pesquisarPorIdAgenda($id)
    {
        $agenda = Agenda::find($id);
        if ($agenda == null) {
            return response()->json([
                "status" => false,
                "message" => "Agendamento não encontrado"
            ]);
        }
        return response()->json([
            "status" => true,
            "data" => $agenda
        ]);
    }

    public function pesquisarPorData(Request $request)
    {
        $agenda = Agenda::where('data_hora', 'like', '%' . $request->data_hora . '%')->get();
        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }

    public function pesquisarPorDataDoProfissional(Request $request)
    {

        if ($request->profissional_id == 0 || $request->profissional_id == '') {
            $agenda = Agenda::all();
        } else {
            $agenda = Agenda::where('profissional_id', $request->profissional_id);

            if (isset($request->data_hora)) {
                $agenda->whereDate('data_hora', '>=', $request->data_hora);
            }
            $agenda = $agenda->get();
        }

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }
}
