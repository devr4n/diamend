<div class="container">
    <canvas id="monthlyIncomeExpenseChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('monthlyIncomeExpenseChart').getContext('2d');
        var monthlyIncome = @json($monthlyIncome);
        var monthlyExpense = @json($monthlyExpense);

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{{ __('general.month.january') }}', '{{ __('general.month.february') }}', '{{ __('general.month.march') }}', '{{ __('general.month.april') }}', '{{ __('general.month.may') }}', '{{ __('general.month.june') }}', '{{ __('general.month.july') }}', '{{ __('general.month.august') }}', '{{ __('general.month.september') }}', '{{ __('general.month.october') }}', '{{ __('general.month.november') }}', '{{ __('general.month.december') }}'],
                datasets: [
                    {
                        label: '{{ __('general.incomes') }}',
                        backgroundColor: 'rgba(75, 192, 192)',
                        borderWidth: 1,
                        data: monthlyIncome
                    },
                    {
                        label: '{{ __('general.expenses') }}',
                        backgroundColor: 'rgba(255, 99, 132)',
                        borderWidth: 1,
                        data: monthlyExpense
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50000 // Set the maximum value of the y-axis
                    }
                }
            }
        });
    });
</script>
