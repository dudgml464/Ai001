<html>
  <head>
    <title>피자 데이터 입력</title>
  </head>
  <body>
		<h1>차트입력 화면</h1>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label>Topping 1:</label>
      <input type="text" name="topping1" required><br><br>
      <label>Topping 2:</label>
      <input type="text" name="topping2" required><br><br>
      <label>Topping 3:</label>
      <input type="text" name="topping3" required><br><br>
      <label>Topping 4:</label>
      <input type="text" name="topping4" required><br><br>
      <label>Topping 5:</label>
      <input type="text" name="topping5" required><br><br>
      <input type="submit" value="Submit">
    </form>
    <?php
	// 폼이 제출되면 회원 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 데이터베이스 연결
		$servername = "localhost";
		$rt = "root";
		$dbname = "web";

		$conn = new mysqli($servername, $rt, $rt, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 데이터 가져오기
		$T1 = $_POST["topping1"];
		$T2 = $_POST["topping2"];
    $T3 = $_POST["topping3"];
    $T4 = $_POST["topping4"];
    $T5 = $_POST["topping5"];

		// SQL 쿼리 실행
		$sql = "INSERT INTO pizza (Topping1,Topping2,Topping3,Topping4,Topping5) VALUES ('$T1', '$T2','$T3', '$T4','$T5')";
		if ($conn->query($sql) === TRUE) {
			echo "INSERT 완료";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	?>
  </body>
</html>
