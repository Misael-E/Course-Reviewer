<?php
/*
	File to read a single profile given a user ID
*/
//headers
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');

//initializing our api
include_once('../../core/initialize.php');

//instantiate post
$post = new Profile($db);


//call function to get student information
$post->ID = isset($_GET['ID']) ? $_GET['ID'] : die();
$post->read_single();
//test variable to see if undergrad or graduate
$check = $post->Year;

$result2 = $post->get_minor();
$row2 = $result2->fetch(PDO::FETCH_ASSOC);
//$MinCode = $row2['MinD_code'];
if($row2 == null)
{
	$MinCode = 'none';
}
else
{
	$MinCode = $row2['MinD_code'];
}

//if undergrad (they have a year)
if($check != null)
{
	$post_arr = array('ID' => $post->ID,'First_name' => $post->First_name,'Last_name' => $post->Last_name,'Date_made' => $post->Date_made,'Username' => $post->Username, 'email_address' => $post->email_address, 'University' => $post->University,	'Dep_code' => $post->Dep_code,	'Has_graduated' => $post->UGHas_graduated,	'Year' => $post->Year,	'Concentration' => $post->Concentration,'Faculty' => $post->UGFaculty, 'Minor Department' => $MinCode);
	
}
//else student is a graduate
else
{
	$post_arr = array('ID' => $post->ID,'First_name' => $post->First_name,'Last_name' => $post->Last_name,'Date_made' => $post->Date_made,'Username' => $post->Username, 'email_address' => $post->email_address, 'University' => $post->University,	'Dep_code' => $post->GDep_code,	'Has_graduated' => $post->GHas_graduated,	'Research_interest' => $post->Research_interest,	'Faculty' => $post->GFaculty, 'Minor Department' => $MinCode);

}


//make a json
print_r(json_encode($post_arr));

?>