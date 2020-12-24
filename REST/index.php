<form action="" method="POST">
<label>Select TSP Name:</label><br />
<?php
include('db.php');
$result = $db->query("SELECT id, name FROM tsp order by name asc");
echo '<select name="tsp_id"><option>Select</option>';
while ($row = $result->fetch_array()) {
	echo '<option value='.$row[0].'>'.$row[1].'</option>';
}
echo '</select>';
?>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>
<?php
if (isset($_POST['tsp_id']) && $_POST['tsp_id']!="") {
	$tsp_id = $_POST['tsp_id'];
	$url = "http://localhost/rest/readapi/".$tsp_id;
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	$result = json_decode($response,true);
	if(isset($result['data']))
	{
		if(count($result['data']) > 0)
		{
			echo "<table><tr><th>ID</th><th>Name</th><th>Round</th><th>Course</th><th>TSP</th></tr>";
			$index = 0;
			while($index < count($result['data']))
			{
				echo "<tr><td>".$result['data'][$index]['stdid']."</td><td>"
				.$result['data'][$index]['stdname']."</td><td>"
				.$result['data'][$index]['round']."</td><td>"
				.$result['data'][$index]['course']."</td><td>"
				.$result['data'][$index]['tspname']."</td><td></tr>";
				$index++;
			}
			echo "</table>";
		}
	}
	else
	{
		echo "No record found";
	}
}
?>