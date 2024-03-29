import {RemoteRunnable} from "langchain/runnables/remote";

    var messages = [];
    
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
        let string = messages[messages.length - 1].user

        const chain = new RemoteRunnable({
            url:import.meta.env.VITE_GPT_ENDPOINT,
        });
        const stream = await chain.stream( string.toLowerCase());
        messages.push({ ai: "" });
        let selector= render_message(messages[messages.length - 1]);
        for await (const chunk of stream) {
            if (typeof chunk === 'string' || chunk instanceof String){
                selector.innerHTML+=chunk
                to_bottom()
            }
        }
        end_loading_state();
    }

    function render_message(element) {
    let chatHolder = document.getElementById("chatHolder");

    let div = document.createElement("div");
    let span = document.createElement("span");
    let time = document.createElement("div");

    const timestamp = new Date();
    const formattedTimestamp = timestamp.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

    if (element.hasOwnProperty("user")) {
        span.textContent = element.user;
        span.classList.add(
        "bg-gray-300",
        "px-2",
        "py-2",
        "mt-2",
        "mb-2",
        "w-1/3",
        "rounded-b-xl",
        "rounded-tr-xl",
        "shadow-yellow-400",
        "shadow-md",
        "loading:animate-pulse"
        );
        div.classList.add("flex", "flex-col", "items-end");
        time.textContent = formattedTimestamp;
        time.classList.add("text-white", "text-sm");
    } else {
        span.textContent = element.ai;
        span.classList.add(
            "bg-red-800",
            "px-2",
            "py-2",
            "rounded-b-xl",
            "rounded-tl-xl",
            "mb-2",
            "mt-2",
            "w-1/2",
            "text-white",
            "shadow-yellow-400",
            "shadow-md",
            "loading:animate-bounce"
        );
        div.classList.add(
        
        );
        time.textContent = formattedTimestamp;
        time.classList.add("text-white", "text-sm");
    
        div.classList.add("flex", "flex-col", "items-start");
    }
    chatHolder.appendChild(div);
    div.appendChild(span);
    div.appendChild(time);
    console.log(time)
    return span
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
    to_bottom()
    }

    function to_bottom(){
        document.getElementById("inputBar").scrollIntoView({ behavior: "smooth"})
    }

    document.getElementById("clear").onclick=clear_conversation
    document.getElementById("newChat").onsubmit=insertNewChat