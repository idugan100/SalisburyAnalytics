<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="description" content="Grade distribution and reviews for courses and professors at Salisbury University.">
    <meta name="keywords" content="Salisbury, Grades, Distribution, Courses, Professors, Analytics">
    <title>{{env("APP_NAME")}}</title>

    @vite('resources/css/app.css')
      <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css"  rel="stylesheet" />
    <link rel="icon" sizes="32x32" href="{{ URL::asset('logo.jpeg') }}" type="image/x-icon"/>
    <script src="https://unpkg.com/htmx.org@1.9.4" integrity="sha384-zUfuhFKKZCbHTY6aRR46gxiqszMk5tcHjsVFxnUo8VMus4kHGVdIYVbOYYNlKmHV" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-200 ">
  <h1 class="text-6xl flex p-4 font-bold {{env("MAIN_BG")}} {{env("ACCENT_TEXT_COLOR")}} border-y-4 justify-center border-black text-center">{{env("APP_NAME")}} <img src="{{ URL::asset('logo.jpeg') }}" alt="SUlogo" class= "w-16 h-16 hover:animate-pulse ml-8"/></h1>
  <x-navbar></x-navbar>

    {{$slot}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>
</html>
<style>
    input.peer:checked + label {
  background-color: {{env("CHART_MAIN")}};
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