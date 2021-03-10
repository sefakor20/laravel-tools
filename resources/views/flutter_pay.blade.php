@php
$array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                array('metaname' => 'size', 'metavalue' => 'big'));
$ref = 'ref_' . rand();
@endphp
<h3>Buy Movie Tickets GHS 90.00</h3>
<form method="POST" action="{{ route('pay') }}" id="paymentForm">
    {{ csrf_field() }}
    <input type="hidden" name="amount" value="90" /> <!-- Replace the value with your transaction amount -->
    <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
    <input type="hidden" name="description" value="Beats by Dre. 2017" /> <!-- Replace the value with your transaction description -->
    <input type="hidden" name="country" value="GH" /> <!-- Replace the value with your transaction country -->
    <input type="hidden" name="currency" value="GHS" /> <!-- Replace the value with your transaction currency -->
    <input type="hidden" name="email" value="ablavi@test.com" /> <!-- Replace the value with your customer email -->
    <input type="hidden" name="firstname" value="Dormelevo" /> <!-- Replace the value with your customer firstname -->
    <input type="hidden" name="lastname" value="Ablavi" /> <!-- Replace the value with your customer lastname -->
    <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
    <input type="hidden" name="phonenumber" value="0509228314" /> <!-- Replace the value with your customer phonenumber -->
    {{-- <input type="hidden" name="paymentplan" value="362" /> <!-- Ucomment and Replace the value with the payment plan id --> --}}
<input type="hidden" name="ref" value="{{ $ref }}" /> <!-- Ucomment and  Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
    {{-- <input type="hidden" name="logo" value="https://pbs.twimg.com/profile_images/915859962554929153/jnVxGxVj.jpg" /> <!-- Replace the value with your logo url (Optional, present in .env)--> --}}
    <input type="hidden" name="title" value="rCodes" /> <!-- Replace the value with your transaction title (Optional, present in .env) -->
    <input type="submit" value="Buy Now"  />
</form>