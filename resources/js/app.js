import Chart from 'chart.js/auto';
window.PeyvandCharts ??= {};

window.PeyvandCharts.createGroupedBarChart = (canvas, chartData) => {
    if (!canvas) {
        throw new Error('Chart canvas was not found.');
    }

    // Prevent duplicate chart instances
    Chart.getChart(canvas)?.destroy();

    const numberFormatter = new Intl.NumberFormat('fa-IR');

    return new Chart(canvas, {
        type: 'bar',

        data: {
            labels: chartData.labels,

            datasets: chartData.datasets.map(dataset => ({
                ...dataset,

                // Each link gets its own side-by-side bars
                grouped: true,

                // Never stack the link bars
                stack: undefined,

                barPercentage: 0.9,
                categoryPercentage: 0.8,
                maxBarThickness: 24,
            })),
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false,
            },

            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',

                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 16,
                    },
                },

                tooltip: {
                    mode: 'index',
                    intersect: false,

                    callbacks: {
                        label(context) {
                            const value = numberFormatter.format(
                                context.parsed.y ?? 0
                            );

                            return `${context.dataset.label}: ${value} کلیک`;
                        },
                    },
                },
            },

            scales: {
                x: {
                    stacked: false,

                    grid: {
                        display: false,
                    },

                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 7,
                        maxRotation: 0,
                    },
                },

                y: {
                    beginAtZero: true,
                    stacked: false,

                    ticks: {
                        precision: 0,

                        callback(value) {
                            return numberFormatter.format(value);
                        },
                    },
                },
            },
        },
    });
};