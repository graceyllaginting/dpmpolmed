<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $events = Agenda::all()->map(function ($agenda) {
            return [
            'title' => $agenda->judul,
            'start' => $agenda->tanggal,
            'extendedProps' => [
                'deskripsi' => $agenda->deskripsi,
                'tanggal' => $agenda->tanggal,
            ],
        ];
        });

        return response()->json($events);
    }
}
