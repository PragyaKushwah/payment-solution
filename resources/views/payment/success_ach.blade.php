@extends('payment.layouts.header')
@section('styles') 
@endsection
@section('content')

    <div class="container ">
        <!-- <div class="row">
            <div class="logo"><img src="images/clearstartlogo.png" alt=""></div>
        </div> -->
        <div class="row content mt-5">
            <div class="col-sm-10 col-md-12 col-lg-6 " >
            <div class="icon">
                <img src="{{ URL::asset('assets/image/correct.png') }}" alt="">
                <h2>Payment <span>Successful!</span></h2>
            </div>
        
        <div class="row content ">
            <div class="col-md-12">

                <p class="form-content text-center"> You will recieve a receipt to your email: {{$email}}</p>
                <p class="form-content">Please be aware, ACH bank payments may take 3-5 business days to clear. To avoid any issues, please have enough funds in your account. Thank you.</p>
            
            </div>
            <div class="col-md-12">
                <div class="pyament-content">
                <p>Amount Paid: ${{$amount}}</p>
                <p>Transaction ID: {{$tran_id}}</p>
                </div>
            </div>
            <hr class="horizontal-line">
            <div class="col-md-12">
               <p class="footer-content">For payment questions, contact our team at <br> billing@clearstarttax.com or <a class="footer-num" href="tel:888-235-0004" >888-235-0004</a>.</p> 

            </div>
        </div>
            </div>
        </div>
        
    </div>
@endsection
@section('scripts')  
@endsection
