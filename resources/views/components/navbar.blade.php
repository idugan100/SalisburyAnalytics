<nav class="bg-gray-200 border-gray-200 ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between sm:justify-center mx-auto p-4">
      
      <button data-collapse-toggle="navbar-solid-bg" type="button" class=" no-highlights inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-yellow-400 rounded-lg bg-gray-200 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-gray-200">
            <li>
                <a href="{{route("gullGPT")}}" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold ">gullGPT</a>
            </li>
            <li>
                <a href="{{route("professors.index")}}" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold ">professors</a>
            </li>
            <li>
                <a href="{{route("courses.index")}}"   class="no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold ">courses</a>
            </li>
            <li id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold ">reports </li>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="{{route("gpa")}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">gpa tracker</a>
                  </li>
                  <li>
                    <a href="{{route("enrollment")}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">enrollment tracker</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="{{route("qtool")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">query tool</a>
                </div>
            </div>
            <li>
                <a href="/about" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold">about</a>
            </li>
            @auth
                @if(auth()->user()->email==env("ADMIN_EMAIL"))
                    <li>
                        <a href="{{route("reviews.processing")}}" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  ">admin</a>
                    </li> 
                @endif

                @if (!auth()->user()->pm_type)                    
                    <li class="flex">
                        <a href="/product-checkout" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  ">checkout</a>
                    
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-800 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-800"></span>
                          </span> 
                    </li>  
                    
                @else
                    <li>
                        <a href="/billing-portal" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  ">billing info</a>
                    </li>
                @endif
                <li>
                    <a class=" decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>    
        @endauth
        @guest
            <li>
                <a href="{{route("premium")}}" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  ">get premium</a>
            </li>
            <li>
                <a href="{{route("login")}}" class=" no-highlights decoration-yellow-400 decoration-4 hover:underline block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 hover:text-red-800 md:p-0 font-bold  ">login</a>
            </li>
        @endguest
        </ul>
      </div>
    </div>
  </nav>