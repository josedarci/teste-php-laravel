<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;

use Illuminate\Support\Facades\Log;

class ProcessDataLater implements ShouldQueue
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
            // Verifica o valor de categoria e atribui o category_id correspondente
            $categoryId = ($this->data['categoria'] === 'Remessa Parcial') ? 1 : 2;

            // Exemplo de salvamento no banco de dados com category_id atribuído
            Document::create([
                'category_id' => $categoryId,
                'title' => $this->data['titulo'],
                'contents' => $this->data['conteúdo'],
            ]);

            // Log de sucesso
            Log::info('Dados processados com sucesso: ' . json_encode($this->data));
        } catch (\Exception $e) {
            // Lidar com erros, se necessário
            Log::error('Erro ao processar dados: ' . $e->getMessage());
        }
    }
}
