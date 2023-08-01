<x-header>
    <x-subHeader title="enter payment information to unlock premium"/>
        <div class="flex justify-center" >
            <div class="max-w-3xl p-6">
                <form id="payment-form" action="/create-subscription" method="POST" class="border-red-700 p-3 border-4">
                    @csrf
                    <div class="m-3">
                        <label >Card Holder Name</label>
                        <input id="card-holder-name" type="text">
                    </div>
                    
                    
                    <!-- Stripe Elements Placeholder -->
                    <div class="m-3">
                        <label for="">Card details</label>
                        <div id="card-element" class="m-3"></div>
                    </div>
                    <div id="error-message" class=" m-3 text-red-700">
                        
                    </div>
                    <button id="card-button" class="bg-yellow-500 p-2 rounded hover:font-bold"data-secret="{{ $intent->client_secret }}">

                        get premium :) 
                    </button>
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
</script>
</x-header>
