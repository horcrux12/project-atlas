var leaveReportChart = document.getElementById("leaveReport").getContext('2d');
var leaveReportData = {
    labels: ["Jan"],
    datasets: [{
        label: 'Jumlah Barang',
        data: [100],
        backgroundColor: "#52CDFF",
        borderColor: [
            '#52CDFF',
        ],
        borderWidth: 0,
        fill: true, // 3: no fill
        
    }]
};

var leaveReportOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            gridLines: {
                display: true,
                drawBorder: false,
                color:"rgba(255,255,255,.05)",
                zeroLineColor: "rgba(255,255,255,.05)",
            },
            ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color:"#6B778C"
            }
        }],
        xAxes: [{
            barPercentage: 0.5,
            gridLines: {
                display: false,
                drawBorder: false,
            },
            ticks: {
            beginAtZero: false,
            autoSkip: true,
            maxTicksLimit: 7,
            fontSize: 10,
            color:"#6B778C"
            }
        }],
    },
    legend:false,
    
    elements: {
        line: {
            tension: 0.4,
        }
    },
    tooltips: {
        backgroundColor: 'rgba(31, 59, 179, 1)',
    }
}
var leaveReport = new Chart(leaveReportChart, {
    type: 'bar',
    data: leaveReportData,
    options: leaveReportOptions
});