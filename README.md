PaypalExpressCheckout
=====================
This simple wrapper builds, sends and interprets the commands sent too the Paypal Express Checkout API (NVP).

The current functionality is limited, but should allow you too:

 - Fetch a payment token
 - Take a payment
 - Setup a payment subscription

Which is acheived by wrapping the following API 'requests':

 - CreateRecurringPaymentsProfile
 - DoExpressCheckoutPayment
 - DoVoid
 - GetExpressCheckoutDetails
 - SetExpressCheckout

and any responses are placed into the 'Response' object, which can be queried for common information API information.

Reading List:
-------------
To understand how this paypal API works I would recommend reading the documentation, the following links should be useful:
 - https://www.sandbox.paypal.com/home
 - https://developer.paypal.com/webapps/developer/docs/classic/express-checkout/integration-guide/ECGettingStarted/
 - Each request class has a link to the corresponding API documentation

Installation:
-------------
The library is PSR-0 compliant and the simplest way to install it is via composer, at the moment it isn't part of the
main composer package library so it can be included by putting:

    {
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/MMTDigital/PaypalExpressCheckout"
            }
        ],
        "require-dev": {
            "mmtdigital/paypalexpresscheckout": "master"
        }
    }

into your composer.json.


Example:
--------
Fetch an 'Express Checkout Token'

    $exCheckout = new \PaypalExpressCheckout\Request\SetExpressCheckout();
    $exCheckout ->setQueryParameter('RETURNURL', 'http://www.example.com/success.php')
                ->setQueryParameter('PAYMENT_REQUEST_0_NOTIFYURL', 'http://www.example.com/notify.php')
                ->setQueryParameter('CANCELURL', 'http://www.example.com/notify.php')

                ->setQueryParameter('L_BILLINGTYPE0', 'RecurringPayments')
                ->setQueryParameter('L_BILLINGAGREEMENTDESCRIPTION0', 'Re-occurring Payment for a subscription')

                ->setQueryParameter('L_PAYMENTREQUEST_0_AMT0', 24.00)
                ->setQueryParameter('L_PAYMENTREQUEST_0_NAME0', 'My Subscription')
                ->setQueryParameter('L_PAYMENTREQUEST_0_QTY0', 1)
                ->setQueryParameter('L_PAYMENTREQUEST_0_NUMBER0', 0)

                ->setQueryParameter('PAYMENTREQUEST_0_PAYMENTACTION', 'Sale')
                ->setQueryParameter('PAYMENTREQUEST_0_AMT', 24.00)
                ->setQueryParameter('PAYMENTREQUEST_0_CURRENCYCODE', 'GBP')
                ->setQueryParameter('PAYMENTREQUEST_0_DESC0', 'My product description')

                ->setUsername('sdk-three_api1.sdk.com')
                ->setPassword('QFZCWN5HZM8VBG7Q')
                ->setSignature('A-IzJhZZjhg29XQ2qnhapuwxIDzyAZQ92FRP5dqBzVesOkzbdUONzmOU');

    if (!$exCheckout->isValid())
    {
        throw new Exception('Missing Parameters: ' . implode(', ', $exCheckout->determineMissingFields()));
    }

    $paypalResponse = $exCheckout->send();
