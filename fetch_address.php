<?php
## Check if the address parameter is set
if(isset($_POST['address'])) {
    ## Get the address from the POST request
    $address = filter_var($_POST['address'], FILTER_DEFAULT);
    $distributor_name = filter_var($_POST['distributor_name'], FILTER_DEFAULT);
    $distributor_reg_no = filter_var($_POST['distributor_reg_no'], FILTER_DEFAULT);

    ## HERE API Key
    $api_key = 'Kx-fp_G-2zEm04p4Jm1dxpcSjofMP-5FRiaebg6XHdQ'; 

    ## Initialize cURL session
    $ch = curl_init();

    ## Set the cURL options
    curl_setopt($ch, CURLOPT_URL, "https://geocode.search.hereapi.com/v1/geocode?q=".urlencode($address)."&apiKey=".$api_key."&in=countryCode:NGA");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    ## Execute the cURL session
    $response = curl_exec($ch);

    ## Check if cURL request was successful
    if($response === false) {
        echo json_encode(array("status" => "error", "message" => "Error occurred while fetching data."));

        echo "invalid";
    } else {
        ## Decode the JSON response
        $data = json_decode($response, true);

        ## Check if the response contains any items
        if(isset($data['items']) && count($data['items']) > 0) {
            ## Address is valid
            echo json_encode(array("status" => "valid", "message" => "Address is valid."));
            
        } else {
            ## Address is invalid
            echo json_encode(array("status" => "invalid", "message" => "Address is invalid."));
        }
    }

    // Close the cURL session
    curl_close($ch);
    } else {
    // If address parameter is not set, return an error message
    echo json_encode(array("status" => "error", "message" => "Address parameter is not set."));
}
?>
