<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessJsonDataJob;
use App\Jobs\ProcessDataLater;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    // Declare a property to hold the items from the queue
    public $itemsDaFila = [];

    public function index()
    {
        return view('import.index', ['itemsDaFila' => $this->itemsDaFila]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json',
        ]);

        $file = $request->file('file');
        $jsonData = json_decode(file_get_contents($file->getPathname()), true);

        DB::statement('CREATE TEMP TABLE temporary_data (
            categoria TEXT,
            titulo TEXT,
            conteudo TEXT
        )');

        foreach ($jsonData['documentos'] as $documento) {
            $jobInfo = [
                'categoria' => $documento['categoria'],
                'titulo' => $documento['titulo'],
                'conteúdo' => $documento['conteúdo'],
            ];

            $this->itemsDaFila[] = $jobInfo;

            DB::table('temporary_data')->insert([
                'categoria' => $documento['categoria'],
                'titulo' => $documento['titulo'],
                'conteudo' => $documento['conteúdo'],
            ]);

            ProcessJsonDataJob::dispatch($jobInfo);
        }

        return view('import.index', ['itemsDaFila' => $this->itemsDaFila])->with('success', 'Importação concluída com sucesso.');
    }

    public function processarFila()
    {
        
        $hasItemsInQueue = Queue::size('default') > 0;
        $hasItemsToProcess = count($this->itemsDaFila) > 0;

        if ($hasItemsInQueue || $hasItemsToProcess) {
            // Process the items from the queue, if any
            foreach ($this->itemsDaFila as $jobInfo) {
                
                ProcessDataLater::dispatch($jobInfo)->onQueue('default');

            }

            Log::info('Jobs ProcessDataLater foram despachados com sucesso.');

            return view('import.index', ['itemsDaFila' => $this->itemsDaFila])->with('success', 'Importação concluída com sucesso.');
        } else {
            Log::info('Nenhum job ProcessDataLater foi despachado, pois não há itens na fila e na lista para processar.');

            return view('import.index', ['itemsDaFila' => $this->itemsDaFila])->with('info', 'Não há itens na fila e na lista para processar.');
        }
    }
}
