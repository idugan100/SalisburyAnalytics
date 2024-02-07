
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/js/langchain.js')
    @vite('resources/css/app.css')
    <link rel="icon" sizes="32x32" href="{{ URL::asset('gully-removebg-preview.png') }}" type="image/x-icon"/>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6125425522876222"crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css"  rel="stylesheet" />
    <title>salisbury analytics</title>
</head>
<body>
    <h1 class="text-6xl flex p-4 font-bold bg-yellow-400 text-red-800 border-y-4 justify-center border-black text-center">salisbury analytics <img src="{{ URL::asset('gully-removebg-preview.png') }}" alt="SUlogo" class= "w-16 h-16 hover:animate-pulse ml-8"/></h1>
    <x-navbar></x-navbar>

    <div class="font-['Proxima Nova'] text-2xl">
        <div class="bg-black  min-h-dvh">

            <div class="border-yellow-400 border-b-2 md:pl-8 md:pr-8 py-4 h-30 shadow-2xl">
                <div class="flex">
                    <div class="md:ml-8 ml-1 col-span-10 text-white text-3xl pt-3 font-bold">gullGPT</div>
                </div>
            </div>

            <div class="flex flex-col space-y-4 md:px-36 px-4 py-10  overflow-auto  ">
                <!--Chatbot messages-->
                <div id="chatHolder"></div>
                <p class=""></p>
            </div>

            <div class=" justify-between border-yellow-400 border-t-2 flex items-center py-4 px-2">
                <div class="pl-12 block  md:flex w-full">
                    <form id="newChat"  class="w-full">
                            <div id="inputBar" >
                                <input type="text" id="message" name="message" placeholder="Ask me something..." class=" w-1/2    bg-gray-300 p-2 outline-none " required/>
                                <button type="submit" class="  bg-yellow-400   mt-1 md:mt-0 rounded md:rounded-r-xl  text-lg h-10 w-20">
                                    send
                                </button>
                            </div>
                    </form>
                    <button id="clear" class="  mt-2 md:mt-0 rounded px-12 py-2 bg-gray-200 text-lg mx-12 ml-auto " >clear</button>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

</body>
</html>