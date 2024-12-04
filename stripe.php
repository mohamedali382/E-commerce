<?php
// include "./authentication.php";
require_once "vendor/autoload.php";
$stripe = new \Stripe\StripeClient("sk_test_51QQBF3JJSMhHB0CmVNfXq92Qa9YWeDQn7AwqNoRnVS6aI36G9U6L4T4xJCv2An5NrIUJI2BxgyW2dBVMdi6g7zm600IXh2lhlK");

try
{
    $payment = $stripe->paymentIntents->retrieve(
        $_POST["payment_id"],
        []
    );
    if ($payment->status == "succeeded")
    {
        echo json_encode([
            "status" => "success",
            "payment" => $payment,
        ]);
        exit();
    }
}
catch (\Exception $exp){
    echo json_encode([
        "status" => "error",
        "message" => $exp->getMessage()
    ]);
    exit();
}
?>