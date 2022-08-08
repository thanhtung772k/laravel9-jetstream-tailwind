$(document).ready(function () {
    $('#js-chart-user').click(function () {
        $('#chart-user').removeClass('hidden');
        $('#list-user').addClass('hidden');
        $('#js-chart-user').addClass('cus-font-style');
        $('#js-list-staff').removeClass('cus-font-style');
    });

    $('#js-list-staff').click(function () {
        $('#chart-user').addClass('hidden');
        $('#list-user').removeClass('hidden');
        $('#js-chart-user').removeClass('cus-font-style');
        $('#js-list-staff').addClass('cus-font-style');
    });

    let dataUser = $('#dataUserChart').val();
    dataUser = JSON.parse(dataUser);
    let labels = $('#titleChart').val();
    labels = JSON.parse(labels);
    const data = {
        labels: labels,
        datasets: [{
            label: 'My First Dataset',
            data: dataUser,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
});
