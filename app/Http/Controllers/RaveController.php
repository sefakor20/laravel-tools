<?php
namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;

//use the Rave Facade
use Rave;

class RaveController extends Controller
{

    // display form to collect payment
    public function formIndex()
    {
        return view('flutter_pay');
    }


  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize(Request $request)
  {
    //   collect client data 
    $data = new TransactionHistory();
    $data->employee_id = 15;
    $data->ref_id = $request->ref;
    $data->name = $request->firstname . ' ' . $request->lastname;
    $data->phone = $request->phonenumber;
    $data->amount = $request->amount;
    $data->save();
    //This initializes payment and redirects to the payment gateway
    //The initialize method takes the parameter of the redirect URL
    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback()
  {

    $res_json = json_decode(request()->request->get('resp'));
    // Get the transaction from your DB using the transaction reference (txref)
    $txref = $res_json->data->transactionobject->txRef;
    $data = Rave::verifyTransaction($txref);

    // Confirm that the chargecode is successful - (00) or (0)
    $chargeResponseCode = $data->data->chargecode;

    // Compare reference_id in db with the reference_id from the response
    $transaction = TransactionHistory::where('ref_id', $txref)->first();

    // Comfirm that the transaction is successful
    if (($chargeResponseCode == "00" || $chargeResponseCode == "0")) {
        // update payment status
        $transaction->update([
            'status' => 'paid'
        ]);
        return redirect(route('payment'));
    } else {
        return redirect('https://youtube.com');
    }



    dd($data);
   
    // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
    
    
    // Confirm that the currency on your db transaction is equal to the returned currency
    // Confirm that the db transaction amount is equal to the returned amount
    // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
    // Give value for the transaction
    // Update the transaction to note that you have given value for the transaction
    // You can also redirect to your success page from here

  }
}