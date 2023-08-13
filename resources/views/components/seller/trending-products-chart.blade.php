<div>
    <canvas id="trending-products-chart"></canvas>
</div>
<script>
    var trendingProducts = @json($trendingProducts);

    console.log(trendingProducts);

    var trendingCtx = document.getElementById('trending-products-chart').getContext('2d');
    var chart = new Chart(trendingCtx, {
        type: 'doughnut',
        data: {
            labels: trendingProducts.labels,
            datasets: [{
                label: 'Total Sales units:',
                data: trendingProducts.data,
                backgroundColor: [
                    'rgba(98, 103, 229, 0.6)',
                    'rgba(145, 112, 225, 0.6)',
                    'rgba(67, 56, 202, 0.6)',
                    'rgba(126, 34, 206, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(98, 103, 229, 1)',
                    'rgba(145, 112, 225, 1)',
                    'rgba(67, 56, 202, 1)',
                    'rgba(126, 34, 206, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Products with top sales in the last 30 days'
                }
            }
        }
    });
</script>
