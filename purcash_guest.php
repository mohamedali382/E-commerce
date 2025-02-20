<?php
include './connect.php';
require_once "vendor/autoload.php";
$amount = $_SESSION['total'];
$stripe = new \Stripe\StripeClient("sk_test_51QQBF3JJSMhHB0CmVNfXq92Qa9YWeDQn7AwqNoRnVS6aI36G9U6L4T4xJCv2An5NrIUJI2BxgyW2dBVMdi6g7zm600IXh2lhlK");
$payment_intent = $stripe->paymentIntents->create([
    'payment_method_types' => ['card'],
    'amount' => round($amount) * 100,
    'currency' => 'aed', 
]);


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

      <h1>Check Out</h1>
      <div class="purcacheForm">
            <input type="hidden" id="stripe-public-key" value="pk_test_51QQBF3JJSMhHB0CmJLlHnoTFjhZgkCGqtGCAlTcA26AUDac1H13KX224MtwW4c3jZjo7voFRESuTk7rxCoI6iDmD00clN2kSre">
            <input type="hidden" id="stripe-payment-intent" value="<?php echo $payment_intent->client_secret;?>">
            <input type="name" name="Fname" id ="user-name" placeholder="your name" required>
            <input type="email" name="Email" id="user-email" placeholder="Email" required>
            <input type="text" name="Address" id ="Address" placeholder="Address" required>
            <input type="number" name="Phone" id="user-phone" placeholder="phone number" required>
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
    // Get input values
    const name = document.getElementById("user-name").value.trim();
    const email = document.getElementById("user-email").value.trim();
    const address = document.getElementById("Address").value.trim();
    const phone = document.getElementById("user-phone").value.trim();
    const stripePaymentIntent = document.getElementById("stripe-payment-intent").value;

    // Construct billingDetails object

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
            const billingDetails = {
            paymentId: result.paymentIntent.id,
            email: email,
            name: name,
            address: address,
            phone: phone
        };
            // Debug: Log the data being sent
    console.log("Sending data:", billingDetails);

// Send data to the backend
fetch("orderProcessing_guest.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({paymentId: result.paymentIntent.id,
        email: email,
            name: name,
            address: address,
            phone: phone})
})
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log("Order processed successfully:", data);
        } else {
            console.error("Error processing order:", data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
    window.location.href = "orderMessage.php";
    console.log("the card has been verified successfully...",result.pa);
        }
    }
    )


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