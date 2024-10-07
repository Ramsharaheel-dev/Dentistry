@extends ('layouts.layout')

@section('head')
<title>Admin &#8211; Dashboard Dian</title>

<style>
.adminForm{
    border: 1px solid #535353;
    padding: 30px;
    margin-bottom: 40px;
    border-radius: 10px;
    background-color: #232323;
}

input, h4{
    color: white;
}

label{
    color:white;
    margin-top:5px;
}

.form-outline input{
    color:white !important;
}

.form-control{
color: white !important;
}

input:focus {
background-color: #232323 !important;
color: white !important;
}

.adminHeading{
    color:white ;
    margin-bottom:10px;
    text-align:center;
}
</style>
@endsection

@section('content')

<div class="container" style="width:40%">
    @if($message != '')
    <?php echo '<script>alert($message)</script>'; ?>
    @endif

    <h4 class="adminHeading">Upload New discount code </h4>

    <div class="adminForm">

        

        <form method="post" action="{{ route('addDiscountCoupon') }}">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" required name="couponCode" class="discountFormInput" placeholder="Enter coupon code" class="form-control" />
                <label class="form-label" for="form1Example1">Coupon Code</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" required name="discount" class="discountFormInput" placeholder="Enter discount" class="form-control" />
                <label class="form-label" for="form1Example2">Discount (%)</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block" style="background-color:#d9aa5a">Upload Discount</button>
        </form>

    </div>

    <h4 class="adminHeading">Update Monthly Subscription</h4>

    <div class="adminForm">

        <form method="post" action="{{ route('updateSubscriptionPlan') }}">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" required name="subscriptionName" class="discountFormInput" placeholder="Enter Subscription Name" class="form-control" />
                <label class="form-label" for="form1Example1">Subscription Name</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" required name="subscriptionPrice" class="discountFormInput" placeholder="Enter price" class="form-control" />
                <label class="form-label" for="form1Example2">Subscription Price</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block" style="background-color:#d9aa5a">Update Plan</button>
        </form>

    </div>
</div>

@endsection