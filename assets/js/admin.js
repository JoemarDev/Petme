var viewChart = document.getElementById('views_per_day').getContext('2d');
var viewChart = new Chart(viewChart, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Visitors',
            data: [],
            backgroundColor: [
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
        legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                   label: function(tooltipItem) {
                          return tooltipItem.yLabel;
                   }
                }
            }
    }
});


let historyObject = [];
$.ajax({
    url : 'lib/petme/read-article.php',
    method : 'POST',
    success:function(data){
        let viewData = JSON.parse(data);
        viewData.forEach(function(data){
           
            let today = new Date(data.date);
            let month = monthNames[today.getMonth()];
            let date = today.getDate();
            console.log(date)
            let dataDate = month + ' ' + date;

            if (historyObject.length == 0) {
                viewChart.data['labels'].push(dataDate);
                viewChart.data.datasets[0].data.push(1)
            } else {
                let lastIndex = viewChart.data.datasets[0].data.length - 1;

                if (dataDate != historyObject[historyObject.length - 1]['date']) {
                    viewChart.data['labels'].push(dataDate);
                    viewChart.data.datasets[0].data.push(1)
                } else {
                     viewChart.data.datasets[0].data[lastIndex] += 1;
                }
            }
            
            viewChart.update();

    
        
            hisObject = {
                'date' : month + ' ' + date,
                'views' : 0,
            };

            historyObject.push(hisObject);
        })
       
    }
});




var comments = document.getElementById('comment_per_day').getContext('2d');
var comments = new Chart(comments, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Comments',
            data: [5,2,6,8,10,52,7,5],
            backgroundColor: [
                'rgba(97,8,186,0.2)',
                'rgba(97,8,186,0.2)',
                'rgba(97,8,186,0.2)',
                'rgba(97,8,186,0.2)',
                'rgba(97,8,186,0.2)',
                'rgba(97,8,186,0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
        }
    }
});



var articleRead = document.getElementById('most_articles_read').getContext('2d');
var articleRead = new Chart(articleRead, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Articles',
            legend: {
                   display: false
               },
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)',
                'rgba(97,8,186,0)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
        }
    }
});


Date.prototype.addDays = function(days) {
    // Add days to given date
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

let today = new Date()

let month = today.addDays(-7).getMonth() + 1;
// console.log(today.addDays(-7).getMonth() +)

let statisticData = [];
const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
  "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
];
for(i = 0; i <= 7; i++) {
 
    let mon = monthNames[today.addDays(-i).getMonth()];
    let data = today.addDays(-i).getDate();
    let fullData = mon + ' ' +data;

    statisticData.push(fullData);
}

// for(x = statisticData.length - 1; x >= 0; x--) {
//     // viewChart.data.labels.push(statisticData[x]);
//     // comments.data.labels.push(statisticData[x]);
//     // articleRead.data.labels.push(statisticData[x]);
// }


$(document).ready(function(){
    $(document).on( 'click', '.publishArticle', function(){
        let elem = $(this);
        let id = $(this).val();
        $(this).parent().parent().parent().parent().hide();
        $.ajax({
            'url' : 'lib/admin/publish.php',
            'method' : 'post',
            'data' : {id : id},
            succsess:function(){
                elem.remove();
            }
        });
    })

    $('.make-admin').click(function(){
        let id = $(this).val();
        $.ajax({
            'url' : 'lib/admin/upgrade-account.php',
            'method' : 'post',
            'data' : {userid : id },
            success:function(){

            }
        })
    })
})
