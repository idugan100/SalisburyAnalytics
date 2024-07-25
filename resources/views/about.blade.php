<x-header>
<x-subHeader title="about"/>
    <div class="flex justify-center">
        <div class="max-w-3xl bg-white mt-16  rounded-lg shadow-lg shadow-black p-2 divide-y-4 divide-sky-500 divide-dotted">
            <div class="text-2xl m-4 p-4">
                Through the Public Information Act, we can provide detailed grade and course information about {{env("UNIVERSITY_NAME")}}. 
                We also anonmyously host appropriate student reviews! Our goal is to provide students with the tools to make informed decisions about their education.
                You can read our privacy policy <a href="{{route("privacy")}}" class="{{env("ACCENT_TEXT_COLOR")}} underline">here</a>.
            </div>
         
        
        </div>

    </div>
</x-header>