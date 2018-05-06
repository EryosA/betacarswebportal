<?PHP
function sendMessage() {
    $content      = array(
        "en" => $_POST['bodyNotif']
    );
    
	$headings=array("en"=>$_POST['titleNotif']);
	
    $fields = array(
        'app_id' => "3074529d-e85c-46d4-9d56-77d5eb61b000",
        'included_segments' => array(
            'All'
        ),
        'contents' => $content,
		'headings' => $headings
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MTBjMDJmYzEtNDQ3Zi00MjZkLThlMWQtOGNlYzMzOTI5MWEy'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response               = sendMessage();
$return["allresponses"] = $response;
$return                 = json_encode($return);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>