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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css"  rel="stylesheet" />
    <link rel="icon" sizes="32x32" href="{{ URL::asset('bar_chart_logo.jpg') }}" type="image/x-icon"/>
    @livewireStyles
</head>
<body class="bg-gray-200 ">
    <h1 class="text-6xl p-4 font-bold bg-yellow-500 text-red-700    border-y-4 border-black text-center">salisbury analytics</h1>
    <x-navbar></x-navbar>

    {{$slot}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    @livewireScripts
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