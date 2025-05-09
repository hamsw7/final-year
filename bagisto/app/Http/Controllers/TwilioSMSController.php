<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;
class TwilioSMSController extends Controller
{
    public function index()
 {
     // Display the view containing the form.
  return view('message');
 }
 public function store(Request $request)
 {
     // Retrieve Twilio credentials from the .env file
  $twilioSid = env('TWILIO_SID');
  $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
  $twilioNumber = env('TWILIO_PHONE_NUMBER');
     // Extract the phone number and message from the request.
  $to = $request->phone;
  $messageBody = $request->message;
  try {
        // Create a new Twilio client using the retrieved credentials
   $client = new Client($twilioSid, $twilioAuthToken);
        // Send the SMS message to the specified phone number
   $client->messages->create($to, [
            'from' => $twilioNumber, // Twilio phone number
            'body' => $messageBody // The message text
        ]);
        // Return success message if the message is sent successfully
   return "Message sent successfully!";
  } catch (Exception $e) {
        // Handle any errors that occur during message sending and return an error message
   return "Error sending message: " . $e->getMessage();
  }
 }
}

