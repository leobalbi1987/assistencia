<!-- resources/views/beneficiarios/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Beneficiário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('beneficiarios.store') }}">
                        @csrf

                        <!-- Nome -->
                        <div class="mt-4">
                            <x-input-label for="nome" :value="__('Nome')" />
                            <x-text-input id="nome" class="block mt-1 w-full" 
                                type="text" 
                                name="nome" 
                                :value="old('nome')" 
                                required />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>

                        <!-- CPF -->
                        <div class="mt-4">
                            <x-input-label for="cpf" :value="__('CPF')" />
                            <x-text-input id="cpf" class="block mt-1 w-full" 
                                type="text" 
                                name="cpf" 
                                :value="old('cpf')" 
                                required />
                            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="mt-4">
                            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                            <x-text-input id="data_nascimento" class="block mt-1 w-full" 
                                type="date" 
                                name="data_nascimento" 
                                :value="old('data_nascimento')" 
                                required />
                            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                        </div>

                        <!-- Endereço -->
                        <div class="mt-4">
                            <x-input-label for="endereco" :value="__('Endereço')" />
                            <x-text-input id="endereco" class="block mt-1 w-full" 
                                type="text" 
                                name="endereco" 
                                :value="old('endereco')" 
                                required />
                            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                        </div>

                        <!-- Telefone -->
                        <div class="mt-4">
                            <x-input-label for="telefone" :value="__('Telefone')" />
                            <x-text-input id="telefone" class="block mt-1 w-full" 
                                type="text" 
                                name="telefone" 
                                :value="old('telefone')" 
                                required />
                            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                        </div>

                        <!-- Dados Familiares -->
                        <div class="mt-4">
                            <x-input-label for="dados_familiares" :value="__('Dados Familiares')" />
                            <textarea id="dados_familiares" 
                                name="dados_familiares" 
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4">{{ old('dados_familiares') }}</textarea>
                            <x-input-error :messages="$errors->get('dados_familiares')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Cadastrar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>