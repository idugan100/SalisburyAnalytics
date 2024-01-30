<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#3C1010]">
    
<h1 class="text-6xl p-4 font-bold bg-yellow-400 text-red-800    border-y-4 border-black text-center">salisbury analytics</h1>
<x-navbar></x-navbar>
<div class="font-['Proxima Nova'] text-2xl">
    <div class="bg-[#3C1010]  h-screen">
        <div class="border-[#FFC31F]/50 border-b-2 md:pl-8 md:pr-8 py-4 h-30 shadow-2xl">
            <div class="flex">
                <a href="https://www.salisbury.edu/">
                    <img src="https://pbs.twimg.com/profile_images/300371774/SU_twitter_400x400.jpg" alt="SUlogo" class= "w-16 h-16 hover:animate-pulse ml-8"/>
                </a>
                <div class="md:ml-8 ml-1 col-span-10 text-white text-3xl pt-3 font-bold">GullGPT</div>
                <a href="https://hoyahacks.georgetown.domains/" class="ml-auto">
                    <img src="https://d112y698adiu2z.cloudfront.net/photos/production/challenge_photos/002/703/676/datas/full_width.png" alt="HOYAlogo" class="w-54 h-16 mr-8 hover:animate-pulse "/>
                </a>
            </div>
        </div>
        <!--Conversation-->
        <div class="flex flex-col space-y-4 md:px-36 px-4 py-10  overflow-auto snap-y snap-mandatory ">
             <!--Chatbot messages-->
             <div id="chatHolder"></div>
             <p class=""></p>
        </div>

        <div class=" justify-between border-[#FFC31F]/50 border-t-2 flex items-center py-4 px-2">
            <div class="pl-12 block  md:flex w-full">
                <form id="newChat" onsubmit="insertNewChat(event)" class="w-full">
                        <div id="inputBar" >
                            <input type="text" id="message" name="message" placeholder="Ask me something..." class=" md:w-1/2 rounded-xl   bg-gray-300 p-2 outline-none " required/>
                            <button type="submit" class=" py-1 bg-[#9D6A1D] p-2  mt-1 md:mt-0 rounded md:rounded-r-xl    text-lg h-12 w-20">
                                Send
                            </button>
                        </div>
                </form>
                <button id="clear" class="  mt-2 md:mt-0 rounded px-12 py-2 bg-red-300 text-lg mx-12 ml-auto" onclick="clear_conversation()">Clear Conversation</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    messages = [];
function insertNewChat(event) {
  event.preventDefault();
  let formData = new FormData(event.target);

  let inputValue = formData.get("message");
  messages.push({ user: inputValue });
  loading_state();
  render_message(messages[messages.length - 1]);
  chat_model();
}

async function chat_model() {
  let string = await get_history_string()

  url = "http://3.144.255.174/chat/su/invoke";
  const response = await fetch(url, {
    method: "POST", // HTTP POST method
    headers: {
      "Content-Type": "application/json", // Specify content type as JSON
    },
    body: JSON.stringify({
      input: string,
      config: {},
      kwargs: {},
    }),
  });
  const responseData = await response.json(); // Parse the response body as JSON
  messages.push({ ai: responseData.output });
  render_message(messages[messages.length - 1]);
  end_loading_state();
}

function render_message(element) {
  let chatHolder = document.getElementById("chatHolder");

  let div = document.createElement("div");
  let span = document.createElement("span");

  if (element.hasOwnProperty("user")) {
    span.textContent = element.user;
    span.classList.add(
      "bg-gray-300",
      "px-2",
      "py-2",
      "mt-2",
      "mb-2",
      "rounded-b-xl",
      "rounded-tr-xl",
      "w-1/3",
      "shadow-[#FFC31F]/25",
      "shadow-lg",
      "loading:animate-pulse"
    );
    div.classList.add("flex", "flex-col", "items-end");
  } else {
    span.textContent = element.ai;
    span.classList.add(
      "px-2",
      "py-2",
      "mt-2",
      "mb-2",
      "rounded-b-xl",
      "rounded-tr-xl",
      "w-1/2",
      "loading:animate-pulse"
    );
    div.classList.add(
      "bg-[#8A0000]",
      "px-2",
      "py-2",
      "rounded-b-xl",
      "rounded-tl-xl",
      "mb-2",
      "mt-2",
      "w-1/2",
      "text-white",
      "shadow-[#FFC31F]/25",
      "shadow-md",
      "loading:animate-bounce"
    );
  }
  chatHolder.appendChild(div);
  div.appendChild(span);
}

function clear_conversation() {
  messages = [];
  let chatHolder = document.getElementById("chatHolder");
  chatHolder.innerHTML = "";
}

function loading_state() {
  let input = document.getElementById("message");
  input.value = "";
  let inputBar = document.getElementById("inputBar");
  inputBar.classList.add("animate-bounce");
  input.disabled = true;
  input.placeholder = "Loading response...";
  let clear = document.getElementById("clear");
  clear.disabled = true;
}

function end_loading_state() {
  let input = document.getElementById("message");
  let inputBar = document.getElementById("inputBar");
  inputBar.classList.remove("animate-bounce");
  input.disabled = false;
  input.placeholder = "Ask me something...";
  let clear = document.getElementById("clear");
  clear.disabled = false;
}

async function get_history_string(){
  var string = "History: ";
  for (let i = 0; i < messages.length - 1; i++) {
    if (i % 2 == 0) {
      // If the message is from the user
      string += "user - " + messages[i].user + "\n"; // Add the user message
    }
    if (i % 2 == 1) {
      // If the message is from the counselor
      string += "salisbury admissions counselor - " + messages[i].ai + "\n"; // Add the counselor message
    }
  }

  url = "http://3.144.255.174/text/summarize/invoke";
  const response = await fetch(url, {
    method: "POST", // HTTP POST method
    headers: {
      "Content-Type": "application/json", // Specify content type as JSON
    },
    body: JSON.stringify({
      input: {"input":string},
      config: {},
      kwargs: {},
    }),
  });
  const data = await response.json()
  // Add the last message (assuming it's a user question)
  output = data.output + "Question: " + messages[messages.length - 1].user + "\n";
  console.log(output)
  return output;
}

</script>