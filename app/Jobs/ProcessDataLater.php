<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessDataLater
{
    use Dispatchable, InteractsWithQueue,Queueable, SerializesModels;

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
            Log::info('Jobs ProcessDataLater recebe os dados da fila');
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
