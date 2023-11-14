<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function criarHorarioProfissional(AgendaFormRequest $request)
    {
        $agendaProfissional = Agenda::create([
            'profissional_id' =>  $request->profissional_id,
            'data_hora' => $request->data_hora

        ]);
        return response()->json([
            "success" => true,
            "message" => "Agendado com sucesso",
            "data" => $agendaProfissional
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
tyuio