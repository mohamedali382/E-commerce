<?php
include "./authentication.php";
require_once "vendor/autoload.php";

$amount = $_SESSION['total'];
$stripe = new \Stripe\StripeClient("sk_test_51QQBF3JJSMhHB0CmVNfXq92Qa9YWeDQn7AwqNoRnVS6aI36G9U6L4T4xJCv2An5NrIUJI2BxgyW2dBVMdi6g7zm600IXh2lhlK");
$payment_intent = $stripe->paymentIntents->create([
    'payment_method_types' => ['card'],
    'amount' => round($amount) * 100,
    'currency' => 'aed', 
]);
// $sql = "SELECT * FORM orders WHERE USER_ID = ['auth_user']['user_id']";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/purcash.css">
    <title>Document</title>
</head>
<body>
    <main>
    <h1>Total Price: <?php echo $_SESSION['total'] ?></h1>
    <?php
    echo "<table border='1'>";
    echo "<thead><tr><th>Name</th><th>Price ID</th><th>Price</th><th>Size</th><th>Count</th></tr></thead>";
    echo "<tbody>";

    // Loop through the order items in session and display them
    foreach ($_SESSION['orderItems'] as $item) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($item['Name']) . "</td>";
        echo "<td>" . htmlspecialchars($item['price_Id']) . "</td>";
        echo "<td>" . htmlspecialchars($item['Price']) . "</td>";
        echo "<td>" . htmlspecialchars($item['Size']) . "</td>";
        echo "<td>" . htmlspecialchars($item['Count']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    ?>
      <h1>Check Out</h1>
        <div class="purcacheForm">
            <input type="hidden" id="stripe-public-key" value="pk_test_51QQBF3JJSMhHB0CmJLlHnoTFjhZgkCGqtGCAlTcA26AUDac1H13KX224MtwW4c3jZjo7voFRESuTk7rxCoI6iDmD00clN2kSre">
            <input type="hidden" id="stripe-payment-intent" value="<?php echo $payment_intent->client_secret;?>">
            <input type="name" id ="user-name" placeholder="your name" value="<?= $_SESSION['auth_user']['Fname']?>" disabled>
            <input type="email" id="user-email" placeholder="Email" value="<?= $_SESSION['auth_user']['Email']?>" disabled>
            <input type="text" id ="Address" placeholder="Address" value="<?= $_SESSION['auth_user']['Address']?>">
            <input type="number" id="user-phone" placeholder="phone number" value="<?= $_SESSION['auth_user']['Phone']?>" disabled>
            <div id="stripe-card-element"></div>
            <button type="button" onclick="payViaStripe()">pay via stripe</button>
        </div>

        <div class="requiredOrder" id="requiredOrder">

        </div>
    </main>
    <script src="https://js.stripe.com/v3/"></script>
<script type="module" src="./js/purcash.js"></script>
<script>
  var stripe = null;
var cardElement = null;
const stripePublicKey = document.getElementById("stripe-public-key").value;
function payViaStripe() {
    const stripePaymentIntent = document.getElementById("stripe-payment-intent").value;
    stripe.confirmCardPayment(stripePaymentIntent, {
        payment_method: {
            card: cardElement, // Make sure this is the card element you mounted
            billing_details: {
                "email": document.getElementById("user-email").value,
                "name": document.getElementById("user-name").value,
                "address": document.getElementById("Address").value,
                "phone": document.getElementById("user-phone").value
            }
        }
    })
    .then(function(result){
        if(result.error)
        {
            console.log(result.error,"y3m error");
        }
        else{
          window.location.href = "orderMessage.php";
            console.log("the card has been verified successfully...",result.pa);
        }
    })
}

function confirmPayment(paymentId){
    var ajax = new XMLHttpRequest();
    ajax.open("POST","stripe.php",true);

    ajax.onreadystatechange = function(){
        if (this.readyState == 4){
            if (this.status == 200){
                var response = JSON.parse(this.responseText);
                console.log(response);
            }
            if (this.status == 500){
                console.log(this.responseText);
            }
        }
    };
    var formData = new FormData();
    formData.append("payment_id", paymentId);
    ajax.send(formData);
}

window.addEventListener("load", () => {
 stripe = Stripe(stripePublicKey); // Initialize Stripe with the public key
var elements = stripe.elements(); // Create an instance of Elements
cardElement = elements.create('card'); // Create a card element
cardElement.mount('#stripe-card-element'); // Mount the card element to the container
});
</script>
</body>
</html>