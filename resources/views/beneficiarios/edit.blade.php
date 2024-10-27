<!-- resources/views/beneficiarios/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Beneficiário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulário de Edição -->
                    <form action="{{ route('beneficiarios.update', $beneficiario) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" class="mt-1 block w-full" value="{{ old('nome', $beneficiario->nome) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="mt-1 block w-full" value="{{ old('cpf', $beneficiario->cpf) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="mt-1 block w-full" value="{{ old('data_nascimento', $beneficiario->data_nascimento->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="endereco" id="endereco" class="mt-1 block w-full" value="{{ old('endereco', $beneficiario->endereco) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="mt-1 block w-full" value="{{ old('telefone', $beneficiario->telefone) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="dados_familiares" class="block text-sm font-medium text-gray-700">Dados Familiares</label>
                            <textarea name="dados_familiares" id="dados_familiares" class="mt-1 block w-full" required>{{ old('dados_familiares', $beneficiario->dados_familiares) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('beneficiarios.index') }}" class="bg-gray-600 text-black px-4 py-2 rounded-md mr-2">Cancelar</a>
                            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-md">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
