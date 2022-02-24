<?php $n = count ( $budget['cats'] ) ; ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['التصنيف', 'المصروفات'],
          <?php for ( $i = 0; $i < $n; $i ++ ) { ?>
          <?php if ( $budget['cats'][$i]['value'] > 0 ) { ?>
          ['<?=$budget['cats'][$i]['name']?>', <?=round ( $budget['cats'][$i]['value'], 2 )?>],
          <?php } ?>
          <?php } ?>
        ]);

        var options = {
          title: 'المصروفات',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart2'));

        chart.draw(data, options);
      }
    </script>