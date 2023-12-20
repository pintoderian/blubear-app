<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('https://digi-api.com/api/v1/digimon?pageSize=20');
        return Inertia::render('Dashboard', [
            'digimons' => $response->json()['content'],
        ]);
    }

    public function find($id)
    {
        $response = Http::get('https://digi-api.com/api/v1/digimon/'.$id);
        return Inertia::render('Digimon', [
            'digimon' => $response->json(),
        ]);
    }
}
