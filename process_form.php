<?php
// Process the contact form submission

// Verify the reCAPTCHA response
$recaptchaResponse = $_POST['g-recaptcha-response'];
$secretKey = '6Leet4AmAAAAALvUVjD70qR3Cvu0zc8KPZHmldmQ';
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

// Make a POST request to the reCAPTCHA API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $verifyUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secretKey, 'response' => $recaptchaResponse)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode the response
$responseData = json_decode($response);

// Check if reCAPTCHA verification was successful
if ($responseData->success) {
    // CAPTCHA verification passed, process the form data
    // Extract and sanitize the form input fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Perform any further processing or validation here

    // Send an email or store the form data in a database
    // ...

    // Send a success response
    $result = array('success' => true, 'message' => 'Form submitted successfully.');
    echo json_encode($result);
} else {
    // CAPTCHA verification failed
    $result = array('success' => false, 'message' => 'CAPTCHA verification failed.');
    echo json_encode($result);
    // Debug: Uncomment the following lines to display additional information
     echo 'Response: ' . $response . '<br>';
     echo 'Error: ' . $responseData->{'error-codes'}[0];
}
?>
