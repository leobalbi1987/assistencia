<!-- resources/views/dashboard/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <!-- Total de Beneficiários -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total de Beneficiários</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalBeneficiarios }}</div>
                        <div class="mt-2 text-sm text-gray-600">{{ $novosBeneficiariosMes }} novos este mês</div>
                    </div>
                </div>

                <!-- Serviços Ativos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Serviços Ativos</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $servicosAtivos }}</div>
                        <div class="mt-2 text-sm text-gray-600">{{ $servicosHoje }} agendados hoje</div>
                    </div>
                </div>

                <!-- Benefícios Ativos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Benefícios Ativos</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $beneficiosAtivos }}</div>
                        <div class="mt-2 text-sm text-gray-600">{{ $beneficiosRevisaoMes }} revisões este mês</div>
                    </div>
                </div>

                <!-- Atendimentos do Mês -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Atendimentos do Mês</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $atendimentosMes }}</div>
                        <div class="mt-2 text-sm text-gray-600">+{{ $crescimentoAtendimentos }}% que mês anterior</div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Gráfico de Atendimentos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Atendimentos nos Últimos 6 Meses</h3>
                        <div class="h-64">
                            <canvas id="atendimentosChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Benefícios por Tipo -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Benefícios por Tipo</h3>
                        <div class="h-64">
                            <canvas id="beneficiosChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Próximos Atendimentos -->
            <div class="mt-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Próximos Atendimentos</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beneficiário</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serviço</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($proximosAtendimentos as $atendimento)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $atendimento->beneficiario->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $atendimento->servico->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $atendimento->data_hora->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $atendimento->status === 'agendado' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst($atendimento->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gráfico de Atendimentos
            const atendimentosCtx = document.getElementById('atendimentosChart').getContext('2d');
            new Chart(atendimentosCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($atendimentosLabels) !!},
                    datasets: [{
                        label: 'Atendimentos',
                        data: {!! json_encode($atendimentosDados) !!},
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico de Benefícios
            const beneficiosCtx = document.getElementById('beneficiosChart').getContext('2d');
            new Chart(beneficiosCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($beneficiosLabels) !!},
                    datasets: [{
                        data: {!! json_encode($beneficiosDados) !!},
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
