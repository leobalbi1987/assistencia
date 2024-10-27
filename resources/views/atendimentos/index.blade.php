<!-- resources/views/relatorios/atendimentos.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Atendimentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Gráfico de Atendimentos por Mês -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Atendimentos por Mês</h3>
                        <div class="h-64">
                            <canvas id="atendimentosPorMes"></canvas>
                        </div>
                    </div>

                    <!-- Gráfico de Status dos Atendimentos -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Status dos Atendimentos</h3>
                        <div class="h-64">
                            <canvas id="statusAtendimentos"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados para o gráfico de atendimentos por mês
        const atendimentosPorMes = new Chart(
            document.getElementById('atendimentosPorMes'),
            {
                type: 'line',
                data: {
                    labels: {!! json_encode($servicosPorMes->pluck('mes')->map(function($mes) { 
    return \Carbon\Carbon::create()->month(intval($mes))->format('F'); 
})) !!}
,
                    datasets: [{
                        label: 'Atendimentos',
                        data: {{ json_encode($servicosPorMes->pluck('total')) }},
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            }
        );

        // Dados para o gráfico de status
        const statusAtendimentos = new Chart(
            document.getElementById('statusAtendimentos'),
            {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($servicosPorStatus->pluck('status')) !!},
                    datasets: [{
                        data: {{ json_encode($servicosPorStatus->pluck('total')) }},
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(255, 99, 132)'
                        ]
                    }]
                }
            }
        );
    </script>
    @endpush --}}
</x-app-layout>