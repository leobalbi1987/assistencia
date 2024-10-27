<!-- resources/views/beneficios/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Benefício') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulário de Criação -->
                    <form action="{{ route('beneficios.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="beneficiario_id" class="block text-sm font-medium text-gray-700">Beneficiário</label>
                            <select name="beneficiario_id" id="beneficiario_id" class="mt-1 block w-full" required>
                                @foreach ($beneficiarios as $beneficiario)
                                    <option value="{{ $beneficiario->id }}">{{ $beneficiario->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <input type="text" name="tipo" id="tipo" class="mt-1 block w-full" value="{{ old('tipo') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="data_concessao" class="block text-sm font-medium text-gray-700">Data de Concessão</label>
                            <input type="date" name="data_concessao" id="data_concessao" class="mt-1 block w-full" value="{{ old('data_concessao') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="data_revisao" class="block text-sm font-medium text-gray-700">Data de Revisão</label>
                            <input type="date" name="data_revisao" id="data_revisao" class="mt-1 block w-full" value="{{ old('data_revisao') }}">
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full" required>
                                <option value="ativo" {{ old('status') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ old('status') === 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea name="observacoes" id="observacoes" class="mt-1 block w-full">{{ old('observacoes') }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('beneficios.index') }}" class="bg-gray-600 text-black px-4 py-2 rounded-md mr-2">Cancelar</a>
                            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-md">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
