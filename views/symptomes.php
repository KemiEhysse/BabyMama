<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Chatbot BabyMama</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf2f8; display: flex; justify-content: center; padding: 50px; }
        .chat-container { width: 400px; background: white; padding: 20px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h3 { color: #db2777; text-align: center; }
        #chat-window { height: 200px; border: 1px solid #eee; overflow-y: auto; margin-bottom: 15px; padding: 10px; border-radius: 10px; background: #fff; }
        .input-area { display: flex; gap: 5px; }
        input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 20px; outline: none; }
        button { background: #db2777; color: white; border: none; padding: 10px 15px; border-radius: 20px; cursor: pointer; }
        .bot-msg { background: #f1f5f9; padding: 8px; border-radius: 10px; margin: 5px 0; font-size: 0.9em; border-left: 4px solid #db2777; }
    </style>
</head>
<body>

<div class="chat-container">
    <h3>Bibi, ton assistant</h3>
    <div id="chat-window">
        <div class="bot-msg">Bonjour ! Tapez un symptôme pour obtenir un conseil.</div>
    </div>
    
    <div class="input-area">
        <input type="text" id="user-input" placeholder="Ex: Constipation...">
        <button onclick="envoyerMessage()">Ok</button>
    </div>
</div>

<script>
function envoyerMessage() {
    const input = document.getElementById('user-input');
    const window = document.getElementById('chat-window');
    const message = input.value;

    if(message === "") return;

    // 1. Envoyer la donnée au PHP via AJAX (Fetch)
    let formData = new FormData();
    formData.append('message', message);

  fetch('../medical/chat_bot.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // On reçoit le JSON
    .then(data => {
        // 2. Afficher la réponse du JSON dans la fenêtre
        window.innerHTML += `<div class='bot-msg'><strong>Maman :</strong> ${message}</div>`;
        window.innerHTML += `<div class='bot-msg' style='background:#fce7f3'><strong>Bibi :</strong> ${data.reply}</div>`;
        input.value = "";
        window.scrollTop = window.scrollHeight;
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert("Le fichier chat_bot.php n'a pas répondu correctement.");
    });
}
</script>

</body>
</html>