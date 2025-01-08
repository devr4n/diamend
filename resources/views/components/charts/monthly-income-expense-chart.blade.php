<div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">
        <i class="fas fa-chart-bar mr-2"></i> {{ __('general.monthly_incomes_and_expenses') }}
    </h6>
    <div class="d-flex align-items-center">
        <!-- Select Year -->
        <select id="yearSelector" class="form-control form-control-sm mr-2" style="width: auto;">
            @for ($year = now()->year; $year >= 2015; $year--)
                <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>

        <!-- Download as Image -->
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-download"></i> {{ __('general.download_chart') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#"
                   onclick="exportChartAsImage('monthlyIncomeExpenseChart', $('#yearSelector').val(), false)">
                    <i class="fas fa-image mr-2"></i> {{ __('general.normal') }}
                </a>
                <a class="dropdown-item" href="#"
                   onclick="exportChartAsImage('monthlyIncomeExpenseChart', $('#yearSelector').val(), true)">
                    <i class="fas fa-image mr-2"></i> {{ __('general.transparent') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Chart & Information -->
<div class="card-body p-3">
    <div class="text-center overflow-auto">
        <canvas id="monthlyIncomeExpenseChart" class="w-100"></canvas>
    </div>
    <p class="mt-3 text-left">
        {{ __('general.monthly_incomes_and_expenses_desc_1') }}
    </p>
    <a target="_blank" rel="nofollow"
       href="{{ route('expenses.index') }}">{{ __('general.click_to_go_expenses') }} →</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('monthlyIncomeExpenseChart').getContext('2d');

        // Chart Data Updating Dynamically
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    '{{ __('general.month.january') }}', '{{ __('general.month.february') }}',
                    '{{ __('general.month.march') }}', '{{ __('general.month.april') }}',
                    '{{ __('general.month.may') }}', '{{ __('general.month.june') }}',
                    '{{ __('general.month.july') }}', '{{ __('general.month.august') }}',
                    '{{ __('general.month.september') }}', '{{ __('general.month.october') }}',
                    '{{ __('general.month.november') }}', '{{ __('general.month.december') }}'
                ],
                datasets: [
                    {
                        label: '{{ __('general.incomes') }}',
                        backgroundColor: 'rgba(75, 192, 192)',
                        borderWidth: 1,
                        data: []  // Empty array to be filled dynamically
                    },
                    {
                        label: '{{ __('general.expenses') }}',
                        backgroundColor: 'rgba(255, 99, 132)',
                        borderWidth: 1,
                        data: []  // Empty array to be filled dynamically
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

        // Update Chart Data with Selected Year
        function updateChartForYear(selectedYear) {
            $.ajax({
                url: '{{ route('monthly-income-expense') }}',
                method: 'GET',
                data: { year: selectedYear },
                success: function (response) {
                    chart.data.datasets[0].data = response.monthlyIncome;
                    chart.data.datasets[1].data = response.monthlyExpense;
                    chart.update();
                },
                error: function (xhr) {
                    console.error('Error fetching data:', xhr.responseText);
                }
            });
        }

        // Initial chart data for current year
        updateChartForYear($('#yearSelector').val());

        // Handle year change
        $('#yearSelector').change(function () {
            updateChartForYear($(this).val());
        });
    });

    // Export Chart as Image (PNG) [Transparent or Normal]
    function exportChartAsImage(chartId, year, transparent) {
        var canvas = document.getElementById(chartId);
        var link = document.createElement('a');
        var backgroundColor = transparent ? 'rgba(0, 0, 0, 0)' : '#ffffff';

        var tempCanvas = document.createElement('canvas');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;

        var ctx = tempCanvas.getContext('2d');
        ctx.fillStyle = backgroundColor;
        ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
        ctx.drawImage(canvas, 0, 0);

        link.download = `monthly_income_expense_${year}.png`;
        link.href = tempCanvas.toDataURL();
        link.click();
    }
</script>
