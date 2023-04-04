<html lang="utf-8">
  <head>
  <?php
    // 데이터베이스 접속 정보 설정
    $servername = "localhost";
    $rt = "root";
    $dbname = "web";

    // MySQL 연결
    $conn = mysqli_connect($servername, $rt, $rt, $dbname);

    // 연결 확인
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 데이터 가져오기
    $sql = "SELECT * FROM pizza ORDER BY cnt DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    // 레코드 가져오기
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
      array_push($data, $row['Topping1'], $row['Topping2'], $row['Topping3'], $row['Topping4'], $row['Topping5']);
    }

    // MySQL 연결 종료
    mysqli_close($conn);
  ?>

  <!-- Google Charts 로드 -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">
      // 데이터 가져오기
      var data = <?php echo json_encode($data); ?>;

      // 차트 그리기
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
          var chartData = new google.visualization.DataTable();
          chartData.addColumn('string', 'Pizza');
          chartData.addColumn('number', 'Percent');
          chartData.addRows([
              [data[0], 20],
              [data[1], 15],
              [data[2], 30],
              [data[3], 10],
              [data[4], 25]
          ]);
          var options = {'title':'나의 피자이야기',
                       'width':400,
                       'height':300};
          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(chartData, options);
      }
  </script>
  </head>
  <body>
    <div id="chart_div"></div>
  </body>
</html>