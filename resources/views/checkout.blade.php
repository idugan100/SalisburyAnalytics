<x-header>
    <x-subHeader title="enter payment information to unlock premium"/>

    <div class="flex justify-center m-4">
        <h3 class="font-bold text-xl">unlock premium features for $3 a month</h3>
    </div>
       

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
        <div class="m-4">
           
            <ul class="md:flex justify-center flex-wrap">
                <li class="m-2 border-black h-1/6 border-2 w-42 p-2 flex flex-col ">
                    <img src="{{ URL::asset('gpa_chart_image.png') }}" class="h-32" alt="">
                    <div>
                        grade point average and enrollment over time charts
                    </div>
                </li>
                <li class="m-2 border-black border-2 h-1/6 w-42 p-2  flex flex-col"> 
                    <img src="{{ URL::asset('grade_distribution_image.png') }}" alt="" class="h-32">
                    <div>grade distributions for individual courses and professors</div>
                </li>
                <li class="m-2 border-black border-2 h-1/6 w-42 p-2  flex flex-col">
                    <img src="{{ URL::asset('course_cards_image.png') }}" alt="" class="h-32">
                    <div>lists of easiest and hardest courses/professors</div>
                </li>
            </ul>
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
