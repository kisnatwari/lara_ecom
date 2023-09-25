@props(['graphData'])

<div>
    <canvas id="barGraph"></canvas>
</div>
<script>
    var barCtx = document.getElementById('barGraph').getContext('2d');
    var myBarGraph = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($graphData[0]),
            datasets: [{
                label: 'Sales (NRs)',
                data: @json($graphData[1]),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgb(255, 89, 532, 0.8)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgb(255, 89, 532, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgb(255, 89, 532, 1)'

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Sales for this year'
                }
            }
        }
    });
</script>
