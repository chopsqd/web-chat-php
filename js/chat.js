const form = document.querySelector(".typing-area"),
      inputField = document.querySelector(".input-field"),
      sendBtn = document.querySelector("button"),
      chatBox = document.querySelector(".chat-box");

form.addEventListener('submit', (event) => {
    event.preventDefault();
})

sendBtn.addEventListener('click', () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../backend/insert-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                inputField.value = "";
                scrollDown();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
})

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave= () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../backend/get-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                chatBox.innerHTML = xhr.response;
                if(!chatBox.classList.contains("active")) {
                    scrollDown();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500)

function scrollDown() {
    chatBox.scrollTop = chatBox.scrollHeight;
}