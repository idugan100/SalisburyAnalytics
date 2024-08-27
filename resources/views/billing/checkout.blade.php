<x-header>
    <x-subHeader title="checkout"/>

    <div class="flex justify-center m-4">
        <h3 class="font-bold text-xl">unlock premium features for $4 a month</h3>
    </div>

    <x-carosel/>

    <div class="flex justify-center" >
        <div class="max-w-3xl p-6">
            <div id="express-checkout-element"></div>

            <form id="payment-form" action="/create-subscription" method="POST" class=" bg-white {{env("ACCENT_BORDER")}} p-3 border-4">
                @csrf
                <div class="m-3">
                    <label  >cardholder name</label>
                    <input class="block h-6" id="card-holder-name" class="rounded" type="text">
                </div>
                    
                <!-- Stripe Elements Placeholder -->
                <div class="m-3">
                    <label for="">card details</label>
                    <div id="card-element" class="m-3"></div>
                </div>

                <div id="error-message" class=" m-3 {{env("ACCENT_TEXT_COLOR")}}">
                    
                </div>
                <div class="flex justify-center"> 
                    <button id="card-button" class="{{env("MAIN_BG")}} p-2 w-96 mt-4 rounded hover:font-bold" data-secret="{{ $intent->client_secret }}">
                        start your free trial :) 
                    </button>
                </div>
                <div class="m-1 flex justify-center">
                    <p>
                        you can cancel at any time!
                    </p>
                </div>
                <div class="m-1">
                    already have a payment method? reactivate your subscription <a href="/billing-portal" class="{{env("ACCENT_TEXT_COLOR")}} font-bold underline"> here</a>
                </div>
            </form>
        </div>
    </div>

<script src="https://js.stripe.com/v3/"></script>
 
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    const form = document.getElementById('payment-form');
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
            }
        }
    );
 
    if (error) {
        document.getElementById("error-message").innerHTML=error.message;
    } else {        
        let token = document.createElement('input');
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
    }
});
const appearance = { /* appearance */ }
const options = { /* options */ }
const express = stripe.elements({
  mode: 'payment',
  amount: 400,
  currency: 'usd',
  appearance,
})
const expressCheckoutElement = express.create('expressCheckout', options)
expressCheckoutElement.mount('#express-checkout-element')
</script>
</x-header>
