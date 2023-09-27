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
@endsection