function sendMessage() {
    let userInput = document.getElementById("user-input").value;
    let chatBox = document.getElementById("chat-box");

    if (userInput.trim() === "") return;

    // Tampilkan pesan user
    let userMessage = `<div class="user-message">${userInput}</div>`;
    chatBox.innerHTML += userMessage;
    
    // Cek apakah user tanya stok atau harga
    if (userInput.toLowerCase().includes("stok") || userInput.toLowerCase().includes("harga")) {
        fetch(`/get-product-info?query=${userInput}`)
            .then(response => response.json())
            .then(data => {
                chatBox.innerHTML += `<div class="bot-message">${data.reply}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                chatBox.innerHTML += `<div class="bot-message">Maaf, ada kesalahan.</div>`;
            });
    } else {
        chatBox.innerHTML += `<div class="bot-message">Maaf, saya tidak mengerti pertanyaan Anda.</div>`;
    }

    document.getElementById("user-input").value = "";
}
