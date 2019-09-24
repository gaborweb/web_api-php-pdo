<?php 

$api_url="http://localhost/home_practice/web_api/test_api.php?action=fetch_all";

$client= curl_init($api_url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response= curl_exec($client);
$result= json_decode($response);

$output="";

if(count($result)){
	
	foreach($result as $row){
		
		$output.="
		
			<tr>
				<td>".$row->id."</td>
				<td>".$row->termekId."</td>
				<td>".$row->darab."</td>
				<td>".$row->termeknev."</td>
				<td>".$row->ar."</td>
				<td>".$row->vasarlo."</td>
				<td><button type='button' name='edit' class='btn btn-warning btn-xs edit' id='".$row->id."'>Szerkeszt</button></td>
				<td><button type='button' name='delete' class='btn btn-danger btn-xs delete' id='".$row->id."'>Töröl</button></td>
			</tr>
		";
	}
}
else{
	
	$output.="
		<tr>
			<td colspan='8' align='center'>No Data Found</td>
		</tr>
	";
}

echo $output;

?>