<?php
  session_start();
  $_SESSION = $_POST;

  require_once($_SERVER['DOCUMENT_ROOT'].'/perch/addons/apps/simple_calendar/stripe-php-master-v2/init.php');

  \Stripe\Stripe::setApiKey("sk_live_4X1Bd1oXesPQY9VxTTq4ptyC");

  $email = perch_member_get('email');

  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'name' => 'Baytown Holiday Cottages Booking',
      'description' => $_SESSION['stripeDescription'],
      'amount' => $_POST['deposit']*100,
      'currency' => 'GBP',
      'quantity' => 1,
    ]],
    'customer_email' => $email,
    'success_url' => 'https://baytownholidaycottages.co.uk/complete-booking',
    'cancel_url' => 'https://baytownholidaycottages.co.uk/fail-booking',
  ]);

?>

<script src="https://js.stripe.com/v3"></script>
<script>
var stripe = Stripe('pk_live_b90Wlyj6LPMkIIcgvsbM6KqU');

stripe.redirectToCheckout({
  // Make the id field from the Checkout Session creation API response
  // available to this file, so you can provide it as parameter here
  // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
  sessionId: '<?php echo $session['id']; ?>'
}).then(function (result) {
  // If `redirectToCheckout` fails due to a browser or network
  // error, display the localized error message to your customer
  // using `result.error.message`.
});
</script>