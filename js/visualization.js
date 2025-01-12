fetch('visualization.php')
    .then(response => response.json())
    .then(data => {
        // Aggregate data by date
        const aggregatedData = data.reduce((acc, curr) => {
            if (!acc[curr.Date]) {
                acc[curr.Date] = 0;
            }
            acc[curr.Date] += parseFloat(curr.Total_Price);
            return acc;
        }, {});

        // Convert aggregated data to arrays
        const labels = Object.keys(aggregatedData); // Dates
        const totalPrices = Object.values(aggregatedData); // Aggregated prices

        // Create chart
        const ctx = document.getElementById('graph').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Price',
                    data: totalPrices,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Price'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
