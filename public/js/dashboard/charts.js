document.addEventListener('DOMContentLoaded', () => {
   // Sales per office chart
   salesPerOfficeChart();

   // Total per office chart
   totalPerOfficeChart();
});

const salesPerOfficeChart = () => {
   const data = document.querySelector('#sales-by-office').dataset.data;

   const parsed = JSON.parse(data);

   const mapped = Object.entries(parsed);

   const bar_data = {
      data: mapped.map((el, i) => [i+1, el[1]]),
      bars: { show: true }
   }

   $.plot('#sales-by-office', [bar_data], {
      grid: {
         borderWidth: 1,
         borderColor: '#f3f3f3',
         tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
            show: true, barWidth: 0.5, align: 'center',
         },
      },
      colors: ['#3c8dbc'],
      xaxis : {
         ticks: mapped.map((el, i) => [i+1, el[0]])
      },
   });
}

const totalPerOfficeChart = () => {
   const data = document.querySelector('#total-by-office').dataset.data;

   const parsed = JSON.parse(data);

   const mapped = Object.entries(parsed);

   const bar_data = {
      data: mapped.map((el, i) => [i+1, el[1]]),
      bars: { show: true }
   }

   $.plot('#total-by-office', [bar_data], {
      grid: {
         borderWidth: 1,
         borderColor: '#f3f3f3',
         tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
            show: true, barWidth: 0.5, align: 'center',
            dataLabels: true
         },
      },
      colors: ['#3cbc82'],
      xaxis : {
         ticks: mapped.map((el, i) => [i+1, el[0]])
      },
      yaxis: {
         tickFormatter: (v, axis) => `$ ${v}`
      }
   });
}