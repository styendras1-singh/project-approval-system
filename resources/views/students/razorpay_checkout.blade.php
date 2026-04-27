<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<button id="rzp-button"
    class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-2 rounded-lg">
    Pay Now
</button>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "{{ $amount * 100 }}",
    "currency": "INR",
    "name": "Student Fee Payment",
    "description": "Pay Fee",
    "order_id": "{{ $order_id }}",

    // ✅ Show all payment options
    "method": {
        "upi": true,
        "card": true,
        "netbanking": true,
        "wallet": true,
        "emi": true
    },

    // Optional UI improvement
    "theme": {
        "color": "#6366F1"
    },

    "prefill": {
        "name": "Student",
        "email": "test@email.com"
    },

    "handler": function (response){
        fetch("{{ route('razorpay.success') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_order_id: "{{ $order_id }}",
                razorpay_signature: response.razorpay_signature
            })
        }).then(() => {
            window.location.href = "/students/{{ $student_id }}/fee-history";
        });
    }
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>