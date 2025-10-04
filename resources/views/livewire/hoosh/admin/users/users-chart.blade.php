<div>

    <canvas id="myChart"></canvas>

    <script src="{{ asset('assets/hoosh//lib/chartjs/chartjs.js') }}"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const labelsData = @json($chartData['labels']);
        const labels = Object.values(labelsData);

        const usersData = @json($chartData['user_data']);
        const usersValues = Object.entries(usersData).map(user => {
            return {
                label: user[0],
                data: Object.values(user[1])
            };
        });

        const datasets = usersValues.map(user => {
            return {
                label: user.label,
                data: user.data
            };
        });

        const data = {
            labels: labels,
            datasets
        };

        const options = {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'مقایسه درصد پاسخ‌دهی افراد در درک مطلب‌ها'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.formattedValue + '%';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        };

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>

</div>
