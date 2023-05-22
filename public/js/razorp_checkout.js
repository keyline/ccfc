let options = {
    "key": "{{ env('RAZORPAY_KEY')}}", // Enter the Key ID generated from the Dashboard
    "amount": "", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "order_IluGWxBm9U8zJ8", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};

const button = document.getElementById('rzp-button1');
button.addEventListener('click', (e, options) => {
    const input = document.getElementById('amount');
    const value = input.value;
    console.log(value); // Do something with the value
    options.amount = (value * 100);
    const rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
});

fetch('/send-options') // Replace with your Laravel route URL
    .then(response => response.json())
    .then(data => {
        // Access the options object
        const options = data.options;

        // Call your JavaScript method and pass the options object
        yourJavaScriptMethod(options);
    })
    .catch(error => {
        console.error('Error:', error);
    });
