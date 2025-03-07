<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../../secrets.php';

$stripe = new \Stripe\StripeClient($secret_key);

$price = $stripe->prices->create([
  'currency' => 'gbp',
  'unit_amount' => $_POST['price'],
  'product_data' => ['name' => $_POST['name']],
]);

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
	# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
	'price' => $price->id,
	'quantity' => 1,
  ]],
  'payment_intent_data' => [
  # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
  'description' => $_POST['name'],
  ],
  'client_reference_id' => $_POST['bookingID'],
  'customer_email' => $_POST['email'],
  'mode' => 'payment',
  'success_url' => $your_domain . '/booking/success',
  'cancel_url' => $your_domain . '/booking/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);