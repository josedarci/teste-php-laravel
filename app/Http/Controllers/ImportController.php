<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessJsonDataJob; // Certifique-se de importar a classe do job

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json',
        ]);

        $file = $request->file('file');
        $jsonData = json_decode(file_get_contents($file->getPathname()), true);

        // Iterar sobre os dados e adicionar cada linha à fila
        foreach ($jsonData['documentos'] as $documento) {
            // Use um job para adicionar os dados à fila
            ProcessJsonDataJob::dispatch($documento);
        }

        return redirect()->route('import.index')->with('success', 'Importação concluída com sucesso.');
    }
}
