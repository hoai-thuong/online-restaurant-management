<form action="{{ route('vnpay.payment') }}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="123456">
    <input type="hidden" name="order_desc" value="Description of the order">
    <input type="hidden" name="order_type" value="product">
    <input type="hidden" name="amount" value="100000">
    <input type="hidden" name="language" value="vn">
    <input type="hidden" name="bank_code" value="">
    <input type="hidden" name="txtexpire" value="{{ now()->addMinutes(30)->format('YmdHis') }}">
    <input type="hidden" name="txt_billing_mobile" value="0987654321">
    <input type="hidden" name="txt_billing_email" value="example@example.com">
    <input type="hidden" name="txt_billing_fullname" value="John Doe">
    <input type="hidden" name="txt_inv_addr1" value="123 Street">
    <input type="hidden" name="txt_bill_city" value="Hanoi">
    <input type="hidden" name="txt_bill_country" value="Vietnam">
    <input type="hidden" name="txt_bill_state" value="Hanoi">
    <input type="hidden" name="txt_inv_mobile" value="0987654321">
    <input type="hidden" name="txt_inv_email" value="example@example.com">
    <input type="hidden" name="txt_inv_customer" value="John Doe">
    <input type="hidden" name="txt_inv_company" value="">
    <input type="hidden" name="txt_inv_taxcode" value="">
    <input type="hidden" name="cbo_inv_type" value="1">
    <button type="submit">Pay with VNPay</button>
</form>
