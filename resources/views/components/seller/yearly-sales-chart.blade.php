<div>
    <canvas id="yearly-sales-chart" class="lg:w-fit"></canvas>
</div>
@php
    
@endphp
<script>
    var chartData = @json($chartData);
    console.log(chartData);
    // Create the line chart
    var lineChartCtx = document.getElementById('yearly-sales-chart').getContext('2d');
    var lineChart = new Chart(lineChartCtx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Daily Sales',
                data: chartData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Total Amount'
                    }
                }
            }
        }
    });
</script>

{{-- 
    
    <canvas id="myChart1"></canvas>
<script>
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First Dataset',
                data: [0, 10, 5, 2, 20, 30, 45],
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1
            }]
        },
        options: {}
    });

    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My Second Dataset',
                data: [10, 5, 15, 8, 25, 20, 30],
                borderColor: 'rgb(54, 162, 235)',
                tension: 0.1
            }]
        },
        options: {}
    });
</script>

    --}}
