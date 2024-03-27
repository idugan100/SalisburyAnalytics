<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="description" content="Grade distribution and reviews for courses and professors at Salisbury University.">
    <meta name="keywords" content="Salisbury, Grades, Distribution, Courses, Professors, Analytics">
    <title>salisbury analytics</title>

    @vite('resources/css/app.css')
      <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css"  rel="stylesheet" />
    <link rel="icon" sizes="32x32" href="{{ URL::asset('gully-removebg-preview.png') }}" type="image/x-icon"/>
    <script src="https://unpkg.com/htmx.org@1.9.4" integrity="sha384-zUfuhFKKZCbHTY6aRR46gxiqszMk5tcHjsVFxnUo8VMus4kHGVdIYVbOYYNlKmHV" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-200 ">
  <h1 class="text-6xl flex p-4 font-bold bg-yellow-400 text-red-800 border-y-4 justify-center border-black text-center">salisbury analytics <img src="{{ URL::asset('gully-removebg-preview.png') }}" alt="SUlogo" class= "w-16 h-16 hover:animate-pulse ml-8"/></h1>
  <a href="https://nam10.safelinks.protection.outlook.com/?url=https%3A%2F%2Fsalisbury.co1.qualtrics.com%2Fjfe%2Fform%2FSV_9uJDW6lY6SgipjU&data=05%7C02%7Csgapres%40gulls.salisbury.edu%7C8bcd6a8450044e94effe08dc4dce831f%7C2472f1faf24f421badd7b01c4b49be07%7C0%7C0%7C638470796565385262%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C0%7C%7C%7C&sdata=Scla2y2dWqLKAKn1xrZy2QuXrQ2Ltvt2MmRIX9jAG5k%3D&reserved=0" target="_blank" class="text-xl flex p-1 font-bold bg-red-800 hover:underline text-yellow-400 border-y-4 justify-center border-black text-center border-t-0">make your voice heard - vote in the SGA election now &#8594 </a>
  <x-navbar></x-navbar>

    {{$slot}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>
</html>
<style>
    input.peer:checked + label {
  background-color: #8b0000;
  color:white;
}
.no-highlights{
      -webkit-tap-highlight-color: transparent;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

</style>