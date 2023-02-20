<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Payment extends Controller
{
    
    public function index($id)
    {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/cases/casefile?CaseID='.$id.'&apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response1 = json_decode($response, true);  
        if(empty($response1['Message'])){
        
                if($response1['status'] == 'success'){
                       $response2 = json_decode($response1['data'], true);
                        
                        $data['CaseID'] = $response2['CaseID']; 
                        $data['FirstName'] = $response2['FirstName']; 
                        $data['LastName'] = $response2['LastName']; 
                        $data['City'] = $response2['City']; 
                        $data['State'] = $response2['State']; 
                        $data['Zip'] = $response2['Zip']; 
                        $data['Address'] = $response2['Address']; 
                        $data['AptNo'] = $response2['AptNo'];
                        $data['CellPhone'] = $response2['CellPhone'];
                        $data['Email'] = $response2['Email']; 
                        
 
                        $curl1 = curl_init();

                        curl_setopt_array($curl1, array(
                          CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/billing/casebillingsummary?CaseID='.$id.'&apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'GET',
                        ));
                        
                        $responsee = curl_exec($curl1);
                        
                        curl_close($curl1);
                        // echo $response;
                        $responsee1 = json_decode($responsee, true);  
                        $PastDuee1= $responsee1['data']['PastDue'];
                        
                        $PastDuee = number_format($PastDuee1);
                        
                        if($PastDuee > 0){ 
                            $data['PastDue'] = $PastDuee;
                        }else{
                            $data['PastDue'] = '0.00';
                        }
                        $data['Balance'] =  $responsee1['data']['Balance']; 
                        
                        
                        return view('payment.index', compact('data'));
                }else{
                      echo "NO DATA FOUND";
                }
    
        }else{
            echo "NO DATA FOUND";
        }
   

    }

   

  
    public function create()
    {
        
    }

    public function store_ach(Request $request)
    {
            
        if(!empty($request->input('client_email'))){
            $email = $request->input('client_email');
        }else{
            $email = '';
        }
        
          $nameOnAccount = $request->input('account_holder_name');
          $bankName = $request->input('bank_name');
          $bankRoutingNo = $request->input('bankrouteingno');
          $bankAccountNo = $request->input('accountno');

         $currentdate = date('Y-m-d');
         $currenttime = date('H:i:s');
         $currentdatetime = $currentdate.'T'.$currenttime;
 
         $accountType = 1;
         $caseID = $request->input('case_id');
         $primaryAccount = true;

         $paymentTypeID = 2;
         $amount = $request->input('amount');
         $paidDate = (string)$currentdatetime;
         $Comment = "Paid";

         $data1 = array(
              "accountType"=> $accountType,
              "bankName" => $bankName,
              "bankRoutingNo" => $bankRoutingNo,
              "bankAccountNo" => $bankAccountNo,
              "nameOnAccount" => $nameOnAccount,
              "caseID" => $caseID,
              "primaryAccount" => true,
              "State" => $request->input('State'),
              "City" => $request->input('City'),
              "Zip" => $request->input('Zip'),
              "Address" => $request->input('Address'),
              "AptNo" => $request->input('AptNo'),
              "emailID" => $email
            //   "phoneNo" => $request->input('phoneNo')
        );
        $encodedData = json_encode($data1);

        $data2 = array(
              "paymentTypeID" =>  $paymentTypeID,
              "amount" =>  $amount,
              "paidDate" =>  $paidDate,
              "Comment" =>  $Comment,
              "caseID" =>  $caseID
        );

        $encodedData2 = json_encode($data2);

         $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/Billing/caseaccount%20?apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $encodedData,
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
            ),
          ));

          $response1 = curl_exec($curl);

          curl_close($curl);
            if($response1){

                $curl1 = curl_init();

                curl_setopt_array($curl1, array(
                  CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/Billing/casepayment?apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => $encodedData2,
            
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));

                $response2 = curl_exec($curl1);

                curl_close($curl1);

                  if($response2){
                    $response21 = json_decode($response2, true);
                    $response22 = json_decode($response21['data'], true);
                    $response22['CasePaymentID'];
                    $curl3 = curl_init();

                    curl_setopt_array($curl3, array(
                      CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/billing/casepayment?CaseID='.$caseID.'&apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response3 = curl_exec($curl3);

                    curl_close($curl3);
                    $response31 = json_decode($response3, true);
                    $response32 = json_decode($response31['data'], true);
                   
                    foreach($response32 as $r){
                      if($r['CasePaymentID'] == $response22['CasePaymentID']){
                        //  echo $r['TransactionStatus']; 
                          $status = $r['TransactionStatus'];
                          $tran_id = $r['TransactionID'];
                          $amount = $r['Amount'];
                         
                          $suc = array("status"=>"$status", "tran_id"=>"$tran_id", "amount"=>"$amount", "email"=>"$email");
                          echo json_encode($suc);
                      }
                    }

                }

            }

    }


    public function store(Request $request)
    {

        if($request->input('card_type') == 'visa'){
          $cardType = 1;
        }else if($request->input('card_type') == 'mastercard'){
          $cardType = 2;
        }else if($request->input('card_type') == 'discover'){
          $cardType = 4;
        }else{
          $cardType = 3;
        }

        if(!empty($request->input('client_email'))){
            $email = $request->input('client_email');
        }else{
            $email = '';
        }
        
        $currentdate = date('Y-m-d');
        $currenttime = date('H:i:s');
        $currentdatetime = $currentdate.'T'.$currenttime;

        $expiry_month = $request->input('expiry_month');
        $expiry_year = $request->input('expiry_year');
        $ccExpDate = $expiry_month.$expiry_year;
 
         $accountType = 2;
         $ccType = $cardType;
         $ccNo = $request->input('card_number');
         $ccSecurityNo = $request->input('cvv');
         $caseID = $request->input('case_id');
         $primaryAccount = true;

         $paymentTypeID = 1;
         $amount = $request->input('amount');
         $paidDate = (string)$currentdatetime;
         $Comment = "Paid";

        $curl = curl_init();
        $data1 = array(
              "accountType"=> $accountType,
              "ccType" => $ccType,
              "ccNo" => $ccNo,
              "ccExpDate" => $ccExpDate,
              "ccSecurityNo" => $ccSecurityNo,
              "caseID" => $caseID,
              "primaryAccount" => true,
              "emailID" => $email
        );
        $encodedData = json_encode($data1);

        $data2 = array(
              "paymentTypeID" =>  $paymentTypeID,
              "amount" =>  $amount,
              "paidDate" =>  $paidDate,
              "Comment" =>  $Comment,
              "caseID" =>  $caseID
        );

        $encodedData2 = json_encode($data2);

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/Billing/caseaccount%20?apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $encodedData,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response1 = curl_exec($curl);

        curl_close($curl);
        // echo $response1;
        if($response1){

            $curl1 = curl_init();

            curl_setopt_array($curl1, array(
              CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/Billing/casepayment?apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $encodedData2,
          
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response2 = curl_exec($curl1);

            curl_close($curl1);
           
            if($response2){
                $response21 = json_decode($response2, true);
                $response22 = json_decode($response21['data'], true);
                $response22['CasePaymentID'];
                $curl3 = curl_init();

                curl_setopt_array($curl3, array(
                  CURLOPT_URL => 'https://clearstart.irslogics.com/publicapi/2020-02-22/billing/casepayment?CaseID='.$caseID.'&apikey=f08f2b3c48ad4134b4ef62abd4aa721d',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response3 = curl_exec($curl3);

                curl_close($curl3);
              
                $response31 = json_decode($response3, true); 
                $response32 = json_decode($response31['data'], true); 
                
                foreach($response32 as $r){
                  if($r['CasePaymentID'] == $response22['CasePaymentID']){  
                      $status = $r['TransactionStatus'];
                      $tran_id = $r['TransactionID'];
                      $amount = $r['Amount'];
                     
                      $suc = array("status"=>"$status", "tran_id"=>"$tran_id", "amount"=>"$amount", "email"=>"$email");
                      echo json_encode($suc);
                    //   array("status"=>"$r['TransactionStatus']", "tran_id"=>"$r['TransactionID']"); 
                    //  echo $r['TransactionID']; 
                    //  echo $r['Amount']; 
                  }
                }
               
            }
             

        }

        
    }

   
    public function success_card($amount, $tran_id, $email)
    {
        return view('payment.success_card', compact('amount', 'tran_id', 'email'));
    }
    
    
    public function success_ach($amount, $tran_id, $email)
    {
        return view('payment.success_ach', compact('amount', 'tran_id', 'email'));
    }


   
    public function edit($id)
    {
        
    }

   
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        
    }

     public function store_test()
    {
        echo "test";
    }
}
