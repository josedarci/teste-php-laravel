<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessJsonDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
           
             //dispatch(new ProcessDataLater($this->data));

            // Log de sucesso
            Log::info('Dados enfileirados com sucesso: ' . json_encode($this->data));
        } catch (\Exception $e) {
            // Lidar com erros, se necessário
            Log::error('Erro ao enfileirar dados: ' . $e->getMessage());
        }
    }
}
