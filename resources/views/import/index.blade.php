@extends('layouts.app')

@section('content')
<div style="width:800px;margin-left:30%;margin-top:10px" class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 border rounded shadow">
        <div class="text-center">
            <h1>Importar Arquivo JSON</h1><br><br>
        </div>

        <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group text-center">
                <label for="file" style="margin: 5px; background-color: black; color: white; padding: 5px; height: 40px; width: 250px; border-radius: 15px; display: inline-block; cursor: pointer;">
                    Selecione o arquivo Json<input type="file" name="file" id="file" class="form-control" style="display: none;">
                </label>


            </div>

            <div class="flex justify-center items-center mb-4 mt-6">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary text-white bg-green-500 hover:bg-green-600 border-none py-2 px-4 rounded-lg text-center text-base flex items-center">
                        <img src="{{ asset('icons/upload-de-arquivo.png') }}" alt="Ícone de Importação" class="mr-2">
                        <strong>Importar</strong>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
<br>
<br>
<div style="width:800px;margin-left:30%;margin-top:10px" class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 border rounded shadow mt-4">
        <h2 class="text-center">Itens da Fila</h2><br>
        <div style="display: flex; justify-content: center; align-items: center; ">
            <button type="button" id="processarFilaBtn" onclick="processarFila();" style="margin-bottom: 20px;" class="btn btn-primary text-white bg-blue-500 hover:bg-blue-600 border-none py-2 px-4 rounded-lg text-center text-base" onclick="processarFila()">Processar Fila</button>
        </div>

        <table style="border-collapse: collapse; background: #FFFFF0;" class="table">
    <thead>
        <tr>
            <th style="border: 1px solid black; background: #F0FFF0;" scope="col">Categoria</th>
            <th style="border: 1px solid black; background: #F0FFF0;" scope="col">Título</th>
            <th style="border: 1px solid black; background: #F0FFF0;" scope="col">Conteúdo</th>
        </tr>
    </thead>
    <tbody>
        {{-- Verificar se $itemsDaFila está definido e não vazio --}}
        @if (!empty($itemsDaFila))
        {{-- Loop para exibir itens da fila --}}
        @foreach ($itemsDaFila as $item)
        <tr scope="row">
            <td style="border: 1px solid black;">{{ $item['categoria'] }}</td>
            <td style="border: 1px solid black;">{{ $item['titulo'] }}</td>
            <td style="border: 1px solid black;">
                {{ strlen($item['conteúdo']) > 100 ? substr($item['conteúdo'], 0, 100) . '...' : $item['conteúdo'] }}
            </td>
        </tr>
        @endforeach
        @else
        <tr scope="row">
            <td colspan="3" style="border: 1px solid black;" class="text-center">Nenhum item na fila no momento.</td>
        </tr>
        @endif
    </tbody>
</table>

        <script>
            /*document.addEventListener("DOMContentLoaded", function() {

                var processarFilaBtn = document.getElementById("processarFilaBtn");
                processarFilaBtn.addEventListener("click", function() {
                    processarFila();
                });
            });*/

            function processarFila() {
                console.log('processarFila -> ok');
                var xhr = new XMLHttpRequest();


                xhr.open("POST", "{{ route('import.processarFila') }}", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");


                xhr.onload = function() {
                    if (xhr.status === 200) {

                        var response = xhr.responseText;
                        console.log(response);
                    } else {

                        console.error("Erro na solicitação AJAX");
                    }
                };


                xhr.onerror = function() {
                    console.error("Erro na solicitação AJAX");
                };


                var data = {};
                xhr.send(JSON.stringify(data));
            }
        </script>

    </div>
</div>

@endsection