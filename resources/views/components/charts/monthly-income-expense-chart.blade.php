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
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: 'Income',
                        backgroundColor: 'rgba(75, 192, 192)',
                        borderWidth: 1,
                        data: monthlyIncome
                    },
                    {
                        label: 'Expense',
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
