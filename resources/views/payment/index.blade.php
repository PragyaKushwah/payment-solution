@extends('payment.layouts.header')
@section('styles') 
@endsection
@section('content')
    
    <!-- home-content section -->
    
    <section class="home-content mx-auto mt-4">

        <div class="main-content contex-2">
            <main class="main-content ">
                <h4 class="main-heading ">@php if(!empty($data['FirstName'])) echo $data['FirstName']; if(!empty($data['LastName'])) echo $data['LastName']; @endphp</h4>
                <p>Case ID: {{$data['CaseID']}}</p>
                <hr class="horizontal-row">
            </main>
        </div>
    </section>
    <!-- home content select payment details -->

    <div action="" class="home-content mx-auto" >

        <input type="radio" id="due-balance" class="balanceamount" name="balance" value="<?=$data['PastDue']?>" checked>
        <label for="due-balance">Past due balance: $@php if(!empty($data['PastDue'])) echo $data['PastDue']; @endphp</label><br>
        <input type="radio" class="balanceamount" id="remaining-balance" name="balance" value="<?=$data['Balance']?>">
        <label for="remaining-balance">Remaining balance: $@php if(!empty($data['Balance'])) echo $data['Balance']; @endphp</label><br>
        <input type="radio" class="balanceamount" id="other" name="balance" value="0">
        <label for="other">Other Amount</label><span style="position: relative; left: 6px;">$</span>
        <input  id="otheramount" type="text" class="other-option" value="" name="otheramount">

        <hr class="horizontal-row">
    </div>



    <div class="payment_details home-content mx-auto">
        <ul class="nav nav-tabs">
            <li class="active toggle_btn"><a href="#home" data-toggle="tab">Pay With Card</a></li>
            <li class="toggle_btn"><a href="#profile" data-toggle="tab">or Pay With Ach</a></li>
        </ul>
        <div id="myTabContent" class="tab-content position-relative">
            <div id="loader"></div>
            <div class="tab-pane active in" id="home">
                <form id="tab" method="post">
                   
                    <div class="container">
                        <div class="error_card"></div>
                        <div class="row">
                            <div class="col-12 col-xs-12 col-md-4 col-md-offset-4">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        
                                            <div class="row mt-3">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Name on card</label>
                                                        <input type="text"  data-ref="cardNumber" autocomplete="off" value="" class="card-input__input" name="name_on_card" id="name_on_card" required>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Card information</label>
                                                        <div class="input-group">
                                                            <input type="text" value="" name="card_number" id="card_number" pattern="[0-9\s]{13,19}" id="cardNumber" data-ref="cardNumber" autocomplete="off" class="card-input__input" required>
                                                            <span ><img src="{{ URL::asset('assets/image/cardpaylogo.png') }}" alt=""></span>
                                                            
                                                            <!-- <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card"></span></span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7 col-md-7">
                                                    <div class="form-group d-flex">
                                                      
                                                        <input type="number" min="1" max="12" value="" name="expiry_month" id="expiry_month" data-ref="" autocomplete="off" class="card-input__input card-details" placeholder="MM" required>
                                                        <input type="number"  min="2023" max="2060" name="expiry_year" id="expiry_year" data-ref="" value="" autocomplete="off" class="card-input__input card-details" placeholder="YYYY" required>
                                                        <input type="number" name="cvv" id="cvv"  data-ref="" value="" autocomplete="off" class="card-input__input" placeholder="CVV" required>
                                                      
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <input type="text" value="@php if(!empty($data['Email'])) echo $data['Email']; @endphp" name="client_email" id="Email1"  data-ref="" autocomplete="off" class="card-input__input" required>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            

                                      
                                    </div>
                                    <input type="hidden" value="" name="card_type" class="card_type">
                                    <!--<input type="hidden" value="{{$data['Email']}}" name="client_email" class="client_email">-->
                                    <input type="hidden" class="balanceamount1" value="<?=$data['Balance']?>" name="amount" class="amount">
                                    <input type="hidden" value="{{$data['CaseID']}}" name="case_id" class="case_id">
                                    <button type="submit" class="card-form__button">Pay</button>
                                    
                                </div>
                            </div>
                            <span id="term_cond_link">By clicking "Pay", you agree to Clear Start Tax Relief's Payment <a class="link_cond" target="_blank" href="https://clearstarttax.com/paymenttermsandconditions">Terms and Conditions.</a> </span>
                                    
                        </div>
                    </div>




                </form>
            </div>

            <div class="tab-pane fade" id="profile">
                <form id="tab2"  method="post">

                    <div class="container">
                        <div class="error_card1"></div>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 col-md-offset-4">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                       
                                            <div class="row mt-3">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Bank Name</label>
                                                        <div class="input-group">
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input" id="bank_name"  name="bank_name" value="" required>

                                                            <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card"></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account Holder Name</label>
                                                        <div class="input-group">
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input" id="account_holder_name"  name="account_holder_name" value="@php if(!empty($data['FirstName'])) echo $data['FirstName']; @endphp @php if(!empty($data['LastName'])) echo $data['LastName']; @endphp" required>

                                                            <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card"></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Routing#</label>
                                                        <div class="input-group">
                                                            <input type="number"  data-ref="" autocomplete="off" name="bankrouteingno" id="bankrouteingno" value="" class="card-input__input" required>

                                                            <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card"></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account#</label>
                                                        <div class="input-group">
                                                            <input type="number" data-ref="" autocomplete="off" value="" id="accountno" name="accountno" class="card-input__input" required>

                                                            <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card"></span></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="mid-heading">Billing Address</label>
                                                    </div>
                                                    <div class="form-group billing-details">
                                                        
                                                        <div class="input-group">
                                                            <label>Street Address 1</label>
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input" id="Address"  name="Address" value="@php if(!empty($data['Address'])) echo $data['Address']; @endphp" required>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group billing-details">
                                                        <div class="input-group">
                                                            <label>Street Address 2(#,Apt,Unit,Suite)</label>
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input margin-right-5" id="AptNo"  name="AptNo" value="@php if(!empty($data['AptNo'])) echo $data['AptNo']; @endphp" >
                                                        </div>
                                                        <div class="input-group">
                                                            <label>City</label>
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input" id="City"  name="City" value="@php if(!empty($data['City'])) echo $data['City']; @endphp" required>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group billing-details">
                                                        <div class="input-group ">
                                                            <label>State:</label>
                                                            <select id="State" name="State" class="card-input__input margin-right-5">
                                                                <option value="saab">select</option>
                                                                <option value="AL">Alabama</option>
                                                                <option value="AK">Alaska</option>
                                                                <option value="AZ">Arizona</option>
                                                                <option value="AR">Arkansas</option>
                                                                <option value="CA">California</option>
                                                                <option value="CO">Colorado</option>
                                                                <option value="CT">Connecticut</option>
                                                                <option value="DE">Delaware</option>
                                                                <option value="DC">District Of Columbia</option>
                                                                <option value="FL">Florida</option>
                                                                <option value="GA">Georgia</option>
                                                                <option value="HI">Hawaii</option>
                                                                <option value="ID">Idaho</option>
                                                                <option value="IL">Illinois</option>
                                                                <option value="IN">Indiana</option>
                                                                <option value="IA">Iowa</option>
                                                                <option value="KS">Kansas</option>
                                                                <option value="KY">Kentucky</option>
                                                                <option value="LA">Louisiana</option>
                                                                <option value="ME">Maine</option>
                                                                <option value="MD">Maryland</option>
                                                                <option value="MA">Massachusetts</option>
                                                                <option value="MI">Michigan</option>
                                                                <option value="MN">Minnesota</option>
                                                                <option value="MS">Mississippi</option>
                                                                <option value="MO">Missouri</option>
                                                                <option value="MT">Montana</option>
                                                                <option value="NE">Nebraska</option>
                                                                <option value="NV">Nevada</option>
                                                                <option value="NH">New Hampshire</option>
                                                                <option value="NJ">New Jersey</option>
                                                                <option value="NM">New Mexico</option>
                                                                <option value="NY">New York</option>
                                                                <option value="NC">North Carolina</option>
                                                                <option value="ND">North Dakota</option>
                                                                <option value="OH">Ohio</option>
                                                                <option value="OK">Oklahoma</option>
                                                                <option value="OR">Oregon</option>
                                                                <option value="PA">Pennsylvania</option>
                                                                <option value="RI">Rhode Island</option>
                                                                <option value="SC">South Carolina</option>
                                                                <option value="SD">South Dakota</option>
                                                                <option value="TN">Tennessee</option>
                                                                <option value="TX">Texas</option>
                                                                <option value="UT">Utah</option>
                                                                <option value="VT">Vermont</option>
                                                                <option value="VA">Virginia</option>
                                                                <option value="WA">Washington</option>
                                                                <option value="WV">West Virginia</option>
                                                                <option value="WI">Wisconsin</option>
                                                                <option value="WY">Wyoming</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="VI">Virgin Islands</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="PW">Palau</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Zip</label>
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input margin-right-5" id="Zip"  name="Zip" value="@php if(!empty($data['Zip'])) echo $data['Zip']; @endphp" required>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group billing-details">
                                                        
                                                        <div class="input-group">
                                                            <label>Email</label>
                                                            <input type="text"  data-ref="" autocomplete="off" class="card-input__input" id="Email"  name="client_email" value="@php if(!empty($data['Email'])) echo $data['Email']; @endphp" required>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>


                                       
                                    </div>
                                    <input type="hidden" class="balanceamount1" value="<?=$data['Balance']?>" name="amount" class="amount">
                                    <!--<input type="hidden" value="{{$data['Email']}}" name="client_email" class="client_email">-->
                                    <input type="hidden" value="{{$data['CaseID']}}" name="case_id" class="case_id">   
                                   <button type="submit" class="card-form__button tab2-btn">Pay</button>
                                </div>
                            </div>
                            <span id="term_cond_link">By clicking "Pay", you agree to Clear Start Tax Relief's Payment <a class="link_cond" target="_blank" href="https://clearstarttax.com/paymenttermsandconditions">Terms and Conditions.</a> </span>
                             
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')  
<script>

$(document).ready(function(){
  $('input[type=radio][name=balance]').change(function(){
    var ba = $("input[name='balance']:checked").val();

    if(ba == 0){ 
        var otherval = $('#otheramount').val(); 
        if(otherval == ''){
            alert('Please enter amount');
             document.getElementById("loader").style.display = "none";
            return false;
           
        }else{
            $('.balanceamount1').val(otherval); 
        }
    }else{
        $('.balanceamount1').val(ba); 
    }
  });
});

$("#otheramount").keyup(function(){
     var otherval = $('#otheramount').val();
     if(otherval == ''){
        $('.balanceamount1').val(''); 
        $('#otheramount').val(''); 
     }else{
        $('.balanceamount1').val(otherval); 
        $('#otheramount').val(otherval); 
     }
      
});


// function cardFormValidate(){
//     var cardValid = 0;

//     //card number validation
//     $('#card_number').validateCreditCard(function(result){
//         if(result.valid){
//             $("#card_number").removeClass('required');
//             cardValid = 1;
//         }else{
//             $("#card_number").addClass('required');
//             cardValid = 0;
//         }
//     });
      
//     //card details validation
//     var cardName = $("#name_on_card").val();
//     var expMonth = $("#expiry_month").val();
//     var expYear = $("#expiry_year").val();
//     var cvv = $("#cvv").val();
//     var regName = /^[a-z ,.'-]+$/i;
//     var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
//     var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
//     var regCVV = /^[0-9]{3,3}$/;
//     if (cardValid == 0) {
//         $("#card_number").addClass('required');
//         $("#card_number").focus();
//         return false;
//     }else if (!regMonth.test(expMonth)) {
//         $("#card_number").removeClass('required');
//         $("#expiry_month").addClass('required');
//         $("#expiry_month").focus();
//         return false;
//     }else if (!regYear.test(expYear)) {
//         $("#card_number").removeClass('required');
//         $("#expiry_month").removeClass('required');
//         $("#expiry_year").addClass('required');
//         $("#expiry_year").focus();
//         return false;
//     }else if (!regCVV.test(cvv)) {
//         $("#card_number").removeClass('required');
//         $("#expiry_month").removeClass('required');
//         $("#expiry_year").removeClass('required');
//         $("#cvv").addClass('required');
//         $("#cvv").focus();
//         return false;
//     }else if (!regName.test(cardName)) {
//         $("#card_number").removeClass('required');
//         $("#expiry_month").removeClass('required');
//         $("#expiry_year").removeClass('required');
//         $("#cvv").removeClass('required');
//         $("#name_on_card").addClass('required');
//         $("#name_on_card").focus();
//         return false;
//     }else{
//         $("#card_number").removeClass('required');
//         $("#expiry_month").removeClass('required');
//         $("#expiry_year").removeClass('required');
//         $("#cvv").removeClass('required');
//         $("#name_on_card").removeClass('required');
//         return true;
//     }
// }
// $(document).ready(function() {
//     //card validation on input fields
//     $('#tab input[type=text]').on('keyup',function(){
//         cardFormValidate();
//     });
// });
$("#card_number").keyup(function(){
    $('#card_number').validateCreditCard(function(result) {
        if(result.card_type == null ){
            $('.error_card').html('Please enter valid credit card');
            $('.error_card').addClass('alert alert-danger');
            return false;
        }else if(result.valid == false){
            $('.error_card').html('Please enter valid credit card');
            $('.error_card').addClass('alert alert-danger');
            return false;
        }else if(result.length_valid == false){
            $('.error_card').html('Please enter valid credit card');
            $('.error_card').addClass('alert alert-danger');
            return false;
        }else if(result.luhn_valid == false){
            $('.error_card').html('Please enter valid credit card');
            $('.error_card').addClass('alert alert-danger');
            return false;
        }else{
            $('.error_card').html('');
            $('.error_card').removeClass('alert alert-danger');
            $('.card_type').val(result.card_type.name); 
            return true;
        }
        
    });
});

$("#expiry_month").keyup(function(){
    var expMonth = $("#expiry_month").val();
      if (expMonth < 1 || expMonth > 13){
        $('.error_card').html('Please enter valid expire month');
        $('.error_card').addClass('alert alert-danger');
        return false;
      }else{
        $('.error_card').html('');
        $('.error_card').removeClass('alert alert-danger');
        return true;
      } 
});

$("#expiry_year").keyup(function(){
    var expYear = $("#expiry_year").val();
      if (expYear < 2023 || expYear > 2060){
        $('.error_card').html('Please enter valid expire year');
        $('.error_card').addClass('alert alert-danger');
        return false;
      }else{
        $('.error_card').html('');
        $('.error_card').removeClass('alert alert-danger');
        return true;
      } 
});

$("#cvv").keyup(function(){
    var cvv = $("#cvv").val();
     var myRe = /^[0-9]{3,4}$/;
     var myArray = myRe.exec(cvv);
     if(cvv!=myArray)
      {
        $('.error_card').html('Please enter valid cvv number');
        $('.error_card').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card').html('');
        $('.error_card').removeClass('alert alert-danger');
        return true; 
     }
}); 

$("#name_on_card").keyup(function(){
    var name_on_card = $("#name_on_card").val();
     var myRe = /^[a-z ,.'-]+$/i;
     var myArray = myRe.exec(name_on_card);
     if(name_on_card!=myArray)
      {
        $('.error_card').html('Please enter valid name');
        $('.error_card').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card').html('');
        $('.error_card').removeClass('alert alert-danger');
        return true; 
     }
}); 
// setTimeout(function() {
//     $(".alert-success").addClass('d-none');
// }, 2000);



$("#tab").submit(function(event) { 
     document.getElementById("loader").style.display = "block";
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ba = $("input[name='balance']:checked").val();

    if(ba == 0){ 
        var otherval = $('#otheramount').val(); 
        if(otherval == ''){
            alert('Please enter amount');
            document.getElementById("loader").style.display = "none";
            return false;
            
        }else{
            $('.balanceamount1').val(otherval); 
        }
    }else{
        $('.balanceamount1').val(ba); 
    }


    // var card_number1 = $("#card_number").val(); 
    // if(card_number1 === ''){ 
    //         $('.error_card').html('Please enter card number');
    //         $('.error_card').addClass('alert alert-danger');
    //          document.getElementById("loader").style.display = "none";
    //         return false;
           
    // }else{ 
    //         $('#card_number').validateCreditCard(function(result) {
    //         if(result.card_type == null ){
    //             $('.error_card').html('Please enter valid credit card');
    //             $('.error_card').addClass('alert alert-danger');
    //              document.getElementById("loader").style.display = "none";
    //              return false;
               
    //         }else if(result.valid == false){
    //             $('.error_card').html('Please enter valid credit card');
    //             $('.error_card').addClass('alert alert-danger');
    //             document.getElementById("loader").style.display = "none";
    //             return false;
                
    //         }else if(result.length_valid == false){
    //             $('.error_card').html('Please enter valid credit card');
    //             $('.error_card').addClass('alert alert-danger');
    //             document.getElementById("loader").style.display = "none";
    //             return false;
                
    //         }else if(result.luhn_valid == false){
    //             $('.error_card').html('Please enter valid credit card');
    //             $('.error_card').addClass('alert alert-danger');
    //             document.getElementById("loader").style.display = "none";
    //             return false;
                
    //         }else{
    //             $('.error_card').html('');
    //             $('.error_card').removeClass('alert alert-danger');
    //             $('.card_type').val(result.card_type.name); 
    //             return true;
    //         }
            
    //     });
    // }

    // var name_on_card1 = $("#name_on_card").val();
    // if(name_on_card1 === ''){
    //         $('.error_card').html('Please enter name');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    // }else{
    //     var myRe = /^[a-z ,.'-]+$/i;
    //      var myArray = myRe.exec(name_on_card1);
    //      if(name_on_card1!=myArray)
    //       {
    //         $('.error_card').html('Please enter valid name');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    //      }else{
    //         $('.error_card').html('');
    //         $('.error_card').removeClass('alert alert-danger');
    //         return true; 
    //      }
    // }
    
    
    // var expMonth1 = $("#expiry_month").val(); 
    // if(expMonth1 === ''){
    //         $('.error_card').html('Please enter expire month');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    // }else{

    //       if (expMonth1 < 1 || expMonth1 > 13){
    //         $('.error_card').html('Please enter valid expire month');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    //       }else{
    //         $('.error_card').html('');
    //         $('.error_card').removeClass('alert alert-danger');
    //         return true;
    //       } 
    // }


    // var expYear1 = $("#expiry_year").val();
    // if(expYear1 === ''){
    //         $('.error_card').html('Please enter expire year');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    // }else{
        
    //           if (expYear1 < 2023 || expYear1 > 2050){
    //             $('.error_card').html('Please enter valid expire year');
    //             $('.error_card').addClass('alert alert-danger');
    //             return false;
    //           }else{
    //             $('.error_card').html('');
    //             $('.error_card').removeClass('alert alert-danger');
    //             return true;
    //           } 
        
    // }


    // var cvv1 = $("#cvv").val();
    // if(cvv1 === ''){
    //         $('.error_card').html('Please enter cvv number');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    // }else{
        
    //      var myRe = /^[0-9]{3,4}$/;
    //      var myArray = myRe.exec(cvv1);
    //      if(cvv1!=myArray)
    //       {
    //         $('.error_card').html('Please enter valid cvv number');
    //         $('.error_card').addClass('alert alert-danger');
    //         return false;
    //      }else{
    //         $('.error_card').html('');
    //         $('.error_card').removeClass('alert alert-danger');
    //         return true; 
    //      }
            
    // }


    formdata = new FormData($(this)[0]);

    $.ajax({
        url: '{{ route('payment-store') }}',
        contentType: false,
        processData: false,
        data: formdata,
        type: 'POST',

        success: function(response)
        { var response = JSON.parse(response);
        
            document.getElementById("loader").style.display = "none";
            if(response['status'] == 'SUCCESS'){
                $("#tab")[0].reset(); 
                $('.error_card').removeClass('alert alert-success');
                // $(".error_card").addClass('alert alert-success');
                // $(".error_card").html('Transaction successfully, Thanks!');

                var amount = response.amount;
                 var tran_id = response.tran_id;
                 var email = response.email;
                window.location = 'https://pragya.dbtechserver.online/paymentSolution/success-card-transaction/' + amount + '/' + tran_id + '/'+ email;
                
            }else{
                $("#tab")[0].reset(); 
                $('.error_card').removeClass('alert alert-danger');
                $(".error_card").addClass('alert alert-danger');
                $(".error_card").html('Transaction ' +response['status'] + ' !Please check card details and try again');
           
                //   var amount = response.amount;
                //  var tran_id = '77';
                //  var email = response.email;
                // window.location = 'https://pragya.dbtechserver.online/paymentSolution/success-card-transaction/' + amount + '/' + tran_id + '/'+ email;
            }
                
        },

    });
    // document.getElementById("loader").style.display = "none";
    // return false;
    
});












var validRoutingNumber = function(routing) {
    if (routing.length !== 9) {
        return false;
    }
    
    // http://en.wikipedia.org/wiki/Routing_transit_number#MICR_Routing_number_format
    var checksumTotal = (7 * (parseInt(routing.charAt(0),10) + parseInt(routing.charAt(3),10) + parseInt(routing.charAt(6),10))) +
                        (3 * (parseInt(routing.charAt(1),10) + parseInt(routing.charAt(4),10) + parseInt(routing.charAt(7),10))) +
                        (9 * (parseInt(routing.charAt(2),10) + parseInt(routing.charAt(5),10) + parseInt(routing.charAt(8),10)));
    
    var checksumMod = checksumTotal % 10;
    if (checksumMod !== 0) {
        return false;
    } else {
        return true;
    }
};

// var testNumbers = '011103093';

$("#bankrouteingno").keyup(function(){
    var testNumbers = $("#bankrouteingno").val();
    if(testNumbers === ""){
        $('.error_card1').html('Please enter valid bank routing number');
        $('.error_card1').addClass('alert alert-danger');
        return false;
    }else{
        var valid = validRoutingNumber(testNumbers); 
        if(valid == false)
        {
            $('.error_card1').html('Please enter valid bank routing number');
            $('.error_card1').addClass('alert alert-danger');
            return false;
         }else{
            $('.error_card1').html('');
            $('.error_card1').removeClass('alert alert-danger');
            return true; 
        }
    }
}); 

$("#accountno").keyup(function(){
    var accountno = $("#accountno").val();
     var myRe = /^[0-9]{9,18}$/;
     var myArray = myRe.exec(accountno);
     if(accountno!=myArray)
      {
        $('.error_card1').html('Please enter valid bank account number');
        $('.error_card1').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card1').html('');
        $('.error_card1').removeClass('alert alert-danger');
        return true; 
     }
}); 

// $("#phoneNo").keyup(function(){
//     var phoneNo = $("#phoneNo").val();
//      var myRe = /^[0-9]{9,11}$/;
//      var myArray = myRe.exec(phoneNo);
//      if(phoneNo!=myArray)
//       {
//         $('.error_card1').html('Please enter valid phone number');
//         $('.error_card1').addClass('alert alert-danger');
//         return false;
//      }else{
//         $('.error_card1').html('');
//         $('.error_card1').removeClass('alert alert-danger');
//         return true; 
//      }
// }); 

$("#Zip").keyup(function(){
    var Zip = $("#Zip").val();
     var myRe = /^[0-9]{4,9}$/;
     var myArray = myRe.exec(Zip);
     if(Zip!=myArray)
      {
        $('.error_card1').html('Please enter valid zip code');
        $('.error_card1').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card1').html('');
        $('.error_card1').removeClass('alert alert-danger');
        return true; 
     }
}); 

$("#bank_name").keyup(function(){
    var bank_name = $("#bank_name").val();
     var myRe = /^[a-z ,.'-]+$/i;
     var myArray = myRe.exec(bank_name);
     if(bank_name!=myArray)
      {
        $('.error_card1').html('Please enter valid bank name');
        $('.error_card1').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card1').html('');
        $('.error_card1').removeClass('alert alert-danger');
        return true; 
     }
}); 

$("#City").keyup(function(){
    var City = $("#City").val();
     var myRe = /^[a-z ,.'-]+$/i;
     var myArray = myRe.exec(City);
     if(City!=myArray)
      {
        $('.error_card1').html('Please enter valid city name');
        $('.error_card1').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card1').html('');
        $('.error_card1').removeClass('alert alert-danger');
        return true; 
     }
});


$("#account_holder_name").keyup(function(){
    var account_holder_name = $("#account_holder_name").val();
     var myRe = /^[a-z ,.'-]+$/i;
     var myArray = myRe.exec(account_holder_name);
     if(account_holder_name!=myArray)
      {
        $('.error_card1').html('Please enter valid account holder name');
        $('.error_card1').addClass('alert alert-danger');
        return false;
     }else{
        $('.error_card1').html('');
        $('.error_card1').removeClass('alert alert-danger');
        return true; 
     }
}); 



$("#tab2").submit(function(event) { 
     document.getElementById("loader").style.display = "block";
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ba1 = $("input[name='balance']:checked").val();

    if(ba1 == 0){ 
        var otherval = $('#otheramount').val(); 
        if(otherval == ''){
            alert('Please enter amount');
            document.getElementById("loader").style.display = "none";
            return false;
            
        }else{
            $('.balanceamount1').val(otherval); 
        }
    }else{
        $('.balanceamount1').val(ba1); 
    }
   

    formdata = new FormData($(this)[0]);

    $.ajax({
        url: '{{ route('payment-ach') }}',
        contentType: false,
        processData: false,
        data: formdata,
        type: 'POST',

        success: function(response)
        {   var response = JSON.parse(response);
            document.getElementById("loader").style.display = "none";
            if(response['status'] == 'SUCCESS'){
                $("#tab2")[0].reset(); 
                $('.error_card1').removeClass('alert alert-success');
              
                 var amount = response.amount;
                 var tran_id = response.tran_id;
                 var email = response.email;
                window.location = 'https://pragya.dbtechserver.online/paymentSolution/success-ach-transaction/' + amount + '/' + tran_id + '/'+ email;
            }else{
                $("#tab2")[0].reset(); 
                $('.error_card1').removeClass('alert alert-danger');
                $(".error_card1").addClass('alert alert-danger');
                $(".error_card1").html('Transaction ' +response['status'] + ' !Please check bank details and try again');
                
            }
                
        },

    });
    
    
});








</script>



@endsection