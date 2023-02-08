<?php
	$server_name = "localhost";
	$username = "root";
	$password = "";
	$database_name = "database96";

	$conn=mysqli_connect($server_name,$username,$password,$database_name);
	if(!$conn){
		die("Connection failed:".mysqli_connect_error());	
	}
	if(isset($_POST['save'])){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$my_date = $_POST['my_date'];

		$sql_query = "INSERT INTO customer_details(first_name, last_name, my_date) VALUES('$first_name', '$last_name', '$my_date')";

		if (mysqli_query($conn, $sql_query)) {
			echo "Customer details inserted successfully!";

			$FileName =$_FILES['file_upload']['name'];
			$TmpName = $_FILES['file_upload']['tmp_name'];

			move_uploaded_file($TmpName, $FileName);
			echo "File Uploaded successfully!";
		}
		else{
			echo "Error:".$sql."".mysqli_error($conn);
		}
		mysqli_close($conn); 
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Financial Chart</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Income', 'Expenses'],
          ['Jan', 19770, 3438],
          ['Feb', 29926, 25382],
          ['Mar', 21500, 26737],
          ['Apr', 29023, 18685],
          ['May', 24486, 22691],
          ['Jun', 29245, 13706],
          ['Jul', 28474, 10402],
          ['Aug', 25398, 12039],
          ['Sep', 33953, 3411],
          ['Oct', 30650, 26110],
          ['Nov', 20149, 9971],
          ['Dec', 30613, 20821],
        ]);

        var options = {
          chart: {
            title: 'Financial Statement',
            subtitle: 'Monthly Income and Expenses: 2013',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</head>
<body>
   <div id="barchart_material" style="width: 900px; height: 500px;"></div>
</body>
</html>