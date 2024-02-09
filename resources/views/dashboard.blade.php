<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-8 border-b-2 border-slate-100 pb-4">
                        {{ __('Dashboard') }}
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 mb-6">
                        <div class="border border-gray-200 p-4 rounded flex flex-col items-center justify-center">
                            <p class="text-2xl mt-2 font-bold">{{ config('app.currency') . $totalBills }}</p>
                            <h2 class="text-l">{{ __('Total Bills') }}</h2>
                        </div>
                        <div class="border border-gray-200 p-4 rounded flex flex-col items-center justify-center">
                            <p class="text-2xl mt-2 font-bold">{{ config('app.currency') . $totalPayments }}</p>
                            <h2 class="text-l">{{ __('Total Payments') }}</h2>
                        </div>
                        <div class="border border-gray-200 p-4 rounded flex flex-col items-center justify-center">
                            <p class="text-2xl mt-2 font-bold">{{ config('app.currency') . $billsThisMonth }}</p>
                            <h2 class="text-l">{{ __('Bills This Month') }}</h2>
                        </div>
                        <div class="border border-gray-200 p-4 rounded flex flex-col items-center justify-center">
                            <p class="text-2xl mt-2 font-bold">{{ config('app.currency') . $paymentsThisMonth }}</p>
                            <h2 class="text-l">{{ __('Payments This Month') }}</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="mt-6 mb-6 font-semibold">{{ __('Billing and payment per month') }}</h3>
                            <canvas id="monthlyChart"></canvas>
                        </div>
                        <div>
                            <h3 class="mt-6 mb-6 font-semibold">{{ __('Billing and payment per day') }}</h3>
                            <canvas id="dailyChart"></canvas>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="border-l-2 bg-neutral-50 border-neutral-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Total Users') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ $totalUsers }}</p>
                        </div>
                        <div class="border-l-2 bg-neutral-50 border-neutral-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Users With Due') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ $usersWithDueCount }}</p>
                        </div>
                        <div class="border-l-2 bg-neutral-50 border-neutral-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Bills This Year') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ config('app.currency') . $billsThisYear }}</p>
                        </div>
                        <div class="border-l-2 bg-neutral-50 border-neutral-500 p-4">
                            <h2 class="text-l font-bold">{{ __('Payments This Year') }}</h2>
                            <p class="text-xl mt-2 font-bold">{{ config('app.currency') . $paymentsThisYear }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold">{{ __('Recent Users') }}</h3>
                                <table class="table-auto border-collapse border-b border-slate-400 mt-4 w-full">
                                    <thead>
                                    <tr>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Name') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Package') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Joined') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recentUsers as $user)
                                        <tr>
                                            <td class="border-b border-slate-300 p-2">{{ $user->name }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ $user->detail->package_name }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ __('Recent Payments') }}</h3>
                                <table class="table-auto border-collapse border-b border-slate-400 mt-4 w-full">
                                    <thead>
                                    <tr>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('User') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Amount') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Date') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recentPayments as $payment)
                                        <tr>
                                            <td class="border-b border-slate-300 p-2">{{ $payment->user->name }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ config('app.currency') . $payment->package_price }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ date('Y-m-d', strtotime($payment->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold">{{ __('Users With Due') }}</h3>
                                <table class="table-auto border-collapse border-b border-slate-400 mt-4 w-full">
                                    <thead>
                                    <tr>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Name') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Package') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Due') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($usersWithDueList as $user)
                                        <tr>
                                            <td class="border-b border-slate-300 p-2">{{ $user->name }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ $user->detail->package_name }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ config('app.currency') . $user->due_amount($user->id) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ __('Recent Tickets') }}</h3>
                                <table class="table-auto border-collapse border-b border-slate-400 mt-4 w-full">
                                    <thead>
                                    <tr>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Subject') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Status') }}</th>
                                        <th class="border-b border-slate-300 p-2 text-left bg-slate-50">{{ __('Date') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recentTickets as $ticket)
                                        <tr>
                                            <td class="border-b border-slate-300 p-2">{{ $ticket->subject }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ $ticket->status }}</td>
                                            <td class="border-b border-slate-300 p-2">{{ date('Y-m-d', strtotime($ticket->created_at)) }}</td>
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
    </div>

    @push('scripts')
        <script>
            const billingData = @json($billingData);
            const paymentData = @json($paymentData);
            const labels = Array.from({ length: billingData.length }, (_, i) => (i + 1).toString());

            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Monthly Billing Amount',
                            data: billingData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Monthly Payment Amount',
                            data: paymentData,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const dailyBillingData = @json($dailyBillingData);
            const dailyPaymentData = @json($dailyPaymentData);
            const dailyLabels = Array.from({ length: dailyBillingData.length }, (_, i) => (i + 1).toString());

            const dailyCtx = document.getElementById('dailyChart').getContext('2d');
            new Chart(dailyCtx, {
                type: 'bar',
                data: {
                    labels: dailyLabels,
                    datasets: [
                        {
                            label: 'Daily Billing Amount',
                            data: dailyBillingData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Daily Payment Amount',
                            data: dailyPaymentData,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>

