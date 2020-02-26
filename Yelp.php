<?php echo file_get_contents("html/leave_a_review.html"); ?>


<?php

$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->append(new http\QueryString(array(
'accessToken' => 'd6plqzhX403PQXp4X-whvk0775siJyuXICKgpEe_5Qhmv95tvDU79UMyeeua5tsQQsQi3cIWT8laMG4bS8Y99roqHh9Bq34JyU3ZJn8pgvLrLIxR3_U9R9tda-tKXnYx',
'bussinessId' => 'Yelp'
)));

$request->setRequestUrl('https://yelpapiserg-osipchukv1.p.rapidapi.com/getBusinessReviews');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setHeaders(array(
'x-rapidapi-host' => 'YelpAPIserg-osipchukV1.p.rapidapi.com',
'x-rapidapi-key' => '87125dbf3amshe57dea6bda65b9ap131e17jsnd75ec5803caa',
'content-type' => 'application/x-www-form-urlencoded'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();

?>










<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
