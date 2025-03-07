<?php

require_once '../../../vendor/autoload.php';
require_once '../../../secrets.php';

$stripe = new \Stripe\StripeClient($secret_key);

// Replace this endpoint secret with your endpoint's unique secret
// If you are testing with the CLI, find the secret by running 'stripe listen'
// If you are using an endpoint defined with the API or dashboard, look in your webhook settings
// at https://dashboard.stripe.com/webhooks
$endpoint_secret = 'whsec_jvyinT8ptCeKM3fQTxJjTvdnSPxjNDxT';

$payload = @file_get_contents('php://input');
$event = null;
try {
  $event = \Stripe\Event::constructFrom(
	json_decode($payload, true)
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  echo 'Webhook error while parsing basic request.';
  http_response_code(400);
  exit();
}

// Handle the event
switch ($event->type) {
  case 'checkout.session.completed':
	  $checkout = $event->data->object;
	  $reference = $event->data->object->client_reference_id;
	  $amount = $event->data->object->amount_total;
	  record_payment($reference, $amount/100);
	  send_confirmation($reference);
	break;
  case 'checkout.session.expired':
	  $checkout = $event->data->object;
	  $reference = $event->data->object->client_reference_id;
	  cancel_booking($reference);
	break;
  default:
	// Unexpected event type
	echo 'Received unknown event type';
}
?>