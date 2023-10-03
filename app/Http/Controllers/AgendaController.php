<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function Funcionariosstore(AgendaFormRequest $request)
    {
        $agenda = Agenda::create([
            'profissional_id' =>  $request->profissional_id,
            'cliente_id' => $request->cliente_id,
            'servico_id' => $request->servico_id,
            'data_hora' => $request->data_hora,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor' => $request->valor

        ]);
        return response()->json([
            "success" => true,
            "message" => "Agendado com sucesso",
            "data" => $agenda
        ], 200);
    }

    public function Clientestore(AgendaFormRequest $request)
    {
        $agenda = Agenda::create([
            'profissional_id' =>  $request->profissional_id,
            'cliente_id' => $request->cliente_id,
            'servico_id' => $request->servico_id,
            'data_hora' => $request->data_hora,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor' => $request->valor

        ]);
        return response()->json([
            "success" => true,
            "message" => "Agendado com sucesso",
            "data" => $agenda
        ], 200);
    }

    public function retornarTodos()
    {
        $agendamentos = Agenda::all();
        return response()->json([
            'status' => true,
            'data' => $agendamentos
        ]);
    }

}
