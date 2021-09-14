<?php
/*
Zaap receiver
v1.0
by @aaviator42

2021-09-13


*/


//Store the endpoint in $endpoint, segmented endpoint in $endpointArray
$endpoint = rtrim(substr(@$_SERVER['PATH_INFO'], 1), '/\\');
$endpointArray = explode("/", $endpoint);

$method = $_SERVER['REQUEST_METHOD'];

$params = $_GET;
if (!empty(file_get_contents('php://input'))){
	$input = json_decode(file_get_contents('php://input'), true);
} else {
	$input = array();
}

$output = array(
	"error" => 0,			//bool: 0 = all ok, 1 = error occured
	"errorMessage" => "",	//if error occurs, store message here
	);


switch($method){
	
	case 'PUT':
		switch($endpointArray[0]){
			case 'putOne':
				putOne();
			break;
			case 'putTwo':
				putTwo();
			break;
			default:
				errorInvalidRequest();
			break;			
		}
	break;
	
	case 'GET':
		switch($endpointArray[0]){
			case 'getOne':
				getOne();
			break;
			case 'getTwo':
				getTwo();
			break;
			default:
				errorInvalidRequest();
			break;
		}
		break;
	
	case 'POST':
		switch($endpointArray[0]){
			case 'postOne':
				postOne();
			break;
			case 'postTwo':
				postTwo();
			break;
			default:
				errorInvalidRequest();
			break;
		}
		break;
	
	case 'DELETE':
		switch($endpointArray[0]){
			case 'deleteOne':
				deleteOne();
			break;
			case 'deleteTwo':
				deleteTwo();
			break;
			default:
				errorInvalidRequest();
			break;
		}
		break;
	default:
		errorInvalidRequest();
	break;
}



function errorInvalidRequest(){
	global $output;
	
	$output["error"] = 1;
	$output["errorMessage"] = "API Remote: Invalid request." . PHP_EOL;
	
	printOutput(400);
}

function printOutput($code = 200){
	global $output;
	header('Content-Type: application/json');
	http_response_code($code);
	echo json_encode($output);
	exit(0);
}

//--your functions go below this line--

function getOne(){
	global $endpoint, $endpointArray;
	global $params, $input, $output;
	
	//$input contains all the information received in the API request body.
	//For example:
	$filename = $input["filename"];
	$line = $input["line"];
	
	//We can do whatever we want with this information.
	//For this example, let's just hash the filename, because why not.
	$hash = md5($filename);
	
	//We return information through $output
	$output["hash"] = $hash;
	$output["filename"] = $input["filename"];
	$output["endpoint"] = $endpoint;
	$output["endpointArray"] = $endpointArray;
	$output["line"] = $input["line"];
	
	//We can also send through a return code, like this:
	$output["returnCode"] = 1;
	
	//Finally, we'll print the JSON-fied output.
	//The function takes an HTTP status code as the argument.
	printOutput(200);
	
}

