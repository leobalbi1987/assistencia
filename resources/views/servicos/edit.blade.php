<!-- resources/views/servicos/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Serviço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulário de Edição -->
                    <form action="{{ route('servicos.update', $servico) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" class="mt-1 block w-full" value="{{ old('nome', $servico->nome) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" class="mt-1 block w-full" required>{{ old('descricao', $servico->descricao) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="vagas" class="block text-sm font-medium text-gray-700">Vagas</label>
                            <input type="number" name="vagas" id="vagas" class="mt-1 block w-full" value="{{ old('vagas', $servico->vagas) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="data_hora" class="block text-sm font-medium text-gray-700">Data e Hora</label>
                            <input type="datetime-local" name="data_hora" id="data_hora" class="mt-1 block w-full" value="{{ old('data_hora', $servico->data_hora->format('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full" required>
                                <option value="agendado" {{ old('status', $servico->status) === 'agendado' ? 'selected' : '' }}>Agendado</option>
                                <option value="em_andamento" {{ old('status', $servico->status) === 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="concluido" {{ old('status', $servico->status) === 'concluido' ? 'selected' : '' }}>Concluído</option>
                                <option value="cancelado" {{ old('status', $servico->status) === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('servicos.index') }}" class="bg-gray-600 text-black px-4 py-2 rounded-md mr-2">Cancelar</a>
                            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-md">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
