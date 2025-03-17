function sendMessage() {
    let userInput = document.getElementById("user-input").value;
    let chatBox = document.getElementById("chat-box");

    if (userInput.trim() === "") return;

    // Tampilkan pesan user
    chatBox.innerHTML += `<div class="user-message">${userInput}</div>`;

    fetch("/chatbot/reply", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ message: userInput }),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response dari backend:", data); // Debugging
        chatBox.innerHTML += `<div class="bot-message">${data.reply}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(error => {
        console.error("Error:", error);
        chatBox.innerHTML += `<div class="bot-message">Maaf, ada kesalahan.</div>`;
    });

    document.getElementById("user-input").value = "";
}
