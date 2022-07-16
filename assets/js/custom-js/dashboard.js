let leaveReportChart = document.getElementById("leaveReport").getContext('2d');

let options = {
    method : 'GET',
    headers : {
        'Content-Type': 'application/json;charset=utf-8'
    }
}

fetch(`${baseUrl}dashboard/data-grafik`, options)
.then(res => res.json())
.then(data => {
    if (data.data.length > 0) {
        let dataLabels  = [];
        let dataValues   = [];

        data.data.forEach(el => {
            dataLabels.push(el.bulan);
            dataValues.push(parseInt(el.jumlah));
        });

        console.log(dataLabels);
        console.log(dataValues);

        let leaveReportData = {
            labels: dataLabels,
            datasets: [{
                label: data.label,
                data: dataValues,
                backgroundColor: "#52CDFF",
                borderColor: [
                    '#52CDFF',
                ],
                borderWidth: 0,
                fill: true, // 3: no fill
                
            }]
        };
    
        let leaveReportOptions = {
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
        
        let leaveReport = new Chart(leaveReportChart, {
            type: 'bar',
            data: leaveReportData,
            options: leaveReportOptions
        });
    }
    
})
.catch(err => {
    console.log(err);
    alert("gagal Mengambil data grafik");
});

