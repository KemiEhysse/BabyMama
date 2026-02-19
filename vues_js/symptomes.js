
//on sélectionne les div importantes

const textarea = document.getElementById("message");
const boutonEnvoyer = document.getElementById("envoie");
const zoneChat = document.getElementById("entree");


//Les phrases prédéfinies

// 30 phrases d'accueil
const phrasesAccueil = [
"Bonjour. Je suis là pour vous écouter.",
"Bonsoir. Dites-moi ce que vous ressentez.",
"Je vous écoute attentivement.",
"Parlez-moi de votre état.",
"Je suis là pour vous aider.",
"Comment vous sentez-vous aujourd'hui ?",
"Dites-moi ce qui vous gêne.",
"Expliquez-moi vos symptômes.",
"Je suis à votre disposition.",
"Racontez-moi ce que vous ressentez.",
"Que se passe-t-il ?",
"Parlez moi de votre état.",
"Je suis avec vous.",
"N'hésitez pas à vous exprimer.",
"Je vous écoute.",
"Que ressentez-vous en ce moment ?",
"Expliquez-moi votre situation.",
"Parlez-moi librement.",
"Je suis là pour vous soutenir.",
"Décrivez votre état.",
"Que puis-je faire pour vous ?",
"Parlez-moi de vos douleurs.",
"Je suis disponible pour vous.",
"Exprimez ce que vous ressentez.",
"Je vous écoute avec attention.",
"Racontez-moi.",
"Que se passe-t-il aujourd'hui ?",
"Dites-moi tout.",
"Je suis prête à vous aider.",
];

// 30 phrases avant conseil
const phrasesIntroConseil = [
"Merci pour votre message.Voici ce que je vous propose.",
"Merci pour ces informations.Voici ce que je vous propose.",
"Merci de me l'avoir expliqué.Voici ce que je vous propose.",
"Je prends note.Voici ce que je vous propose.",
"Merci pour ces précisions.Voici ce que je vous propose.",
"Je comprends votre situation.Voici ce que je vous propose.",
"Merci pour votre confiance.Voici ce que je vous propose.",
"Je vois ce que vous traversez.Voici ce que je vous propose.",
"D'accord, voici ce que je vous propose.",
"Très bien, regardons cela.D'après mes sources,voici ce que je vous propose.",
"Je comprends mieux.Voici ce que je vous propose.",
"Merci pour ces détails.Voici ce que je vous propose.",
"C'est noté.Voici ce que je vous propose.",
"Merci de partager cela.Voici ce que je vous propose.",
"Je comprends votre ressenti.Voici ce que je vous propose.",
"D'accord, écoutons votre corps.Voici ce que je vous propose.",
"Merci.Voici ce que je vous propose.",
"Je vois.Voici ce que je vous propose.",
"Compris.Voici ce que je vous propose.",
"Très bien.Voici ce que je vous propose.",
"Je comprends.Voici ce que je vous propose.",
"Merci beaucoup.Voici ce que je vous propose.",
"Je prends en compte.Voici ce que je vous propose.",
];

// 30 phrases après conseil
const phrasesFinConseil = [
"Prenez soin de vous,la grossesse est un magnifique don!",
"Je reste disponible.Et n'oubliez pas,la grossesse est un magnifique don.",
"N'hésitez pas si besoin.Bon courage pour ces mois à venir.",
"Je suis là pour vous.Prenez bien soin de vous et du bébé.",
"Prenez le temps de vous reposer.Et n'oubliez pas,la grossesse est un magnifique don.",
"Courage, la grossesse est un magnifique don.",
"Je vous souhaite un bon rétablissement.Et n'oubliez pas,la grossesse est un magnifique don.",
"Revenez vers moi si besoin.Et n'oubliez pas,la grossesse est un magnifique don.",
"Je reste à votre écoute.",
"Prenez soin de vous.",
"Je suis avec vous.",
"N'hésitez pas.Tous mes vœux de santé pour vous deux.",
"Bon courage.Tout se passera au mieux pour vous deux, soyez rassurée",
"Je vous accompagne.Hâte que votre bébé soit là.",
"Je suis là.Je vous souhaite de beaux souvenirs de grossesse.",
"Force à vous.Hâte que votre bébé soit là.",
"Je reste disponible pour vous.Hâte que votre bébé soit là.",
"Prenez soin de votre santé.",
"Je vous souhaite du soulagement.Hâte que votre bébé soit là.",
"Je reste présente.",
"Je suis là pour vous aider.Je vous souhaite une belle grossesse.",
"Bon courage.Hâte que votre bébé soit là.",
"Je vous soutiens.Et n'oubliez pas,la grossesse est un magnifique don.",
"Je reste à disposition.",
"Prenez soin de vous.",
"Je suis avec vous.Et n'oubliez pas,la grossesse est un magnifique don.",
"Je reste là.Et n'oubliez pas,la grossesse est un magnifique don.",
"Bon rétablissement.Et n'oubliez pas,la grossesse est un magnifique don.",
"Je vous accompagne.Que tout aille pour le mieux pour vous.",
"Je reste disponible pour vous.Et n'oubliez pas,la grossesse est un magnifique don.",
"Prenez soin de vous.Que votre grossesse se passe au mieux."
];

//ce code permet au chat de répondre quand même quelque chose autre que les conseils
const motsSociaux = ["bonjour","salut","coucou","bonsoir","merci","hey","hello",
"vais bien","au revoir"];

const reponsesSociales = [
    "Merci pour votre message. Je suis là pour vous écouter si vous voulez parler de vos sensations.",
    "Vous pouvez sans cesse me raconter comment vous vous sentez aujourd'hui.",
    "Surtout n'hésitez pas à partager vos ressentis ou simplement discuter avec moi.",
    "Je reste disponible,n'hésitez pas à vous exprimer!"
];

function verifierMessageSocial(message){
    const msgLower = message.toLowerCase();
    const contientSocial = motsSociaux.some(mot => msgLower.includes(mot));
    if(contientSocial){
        return randomPhrase(reponsesSociales);
    }
    return false; 
}


//la fonction pour renvoyer les phrases prédéfinies de manières aléatoire

function randomPhrase(tableau){
    return tableau[Math.floor(Math.random() * tableau.length)];
}


//la fonction qui affiche le message( dans la div de discussion quoi)

function afficherMessage(contenu, auteur){

    const div = document.createElement("div");
    div.className = auteur === "user" ? "message-user" : "message-bot";
    div.textContent = contenu;

    zoneChat.appendChild(div);
    zoneChat.scrollTop = zoneChat.scrollHeight;

    sauvegarderMessage(contenu, auteur);
}


/*la fonction pour sauvegarder la conversation (avce localStorage) puisqu'on n'a pas géré ça côté backend;
le hic est que les utilisatices auront la même interface; mais bon comme on veut juste présenter 
notre chatbot, on pourra régler ça après*/

function sauvegarderMessage(contenu, auteur){
    const historique = JSON.parse(localStorage.getItem("chatMessages")) || [];
    historique.push({contenu, auteur});
    localStorage.setItem("chatMessages", JSON.stringify(historique));
}

window.addEventListener("load", () => {

    const historique = JSON.parse(localStorage.getItem("chatMessages")) || [];

    historique.forEach(msg => {
    // Affichage de l'historique sans le sauvegarder à nouveau
    const div = document.createElement("div");
    div.className = msg.auteur === "user" ? "message-user" : "message-bot";
    div.textContent = msg.contenu;
    zoneChat.appendChild(div);
});

    // si c'est un nouveau chat on envoie un message d'accueil
    
    if(historique.length === 0){
        afficherMessage(randomPhrase(phrasesAccueil), "bot");
    }

});


//la fonction qui gère l'envoi des messages lorsqu'on clique sur le bouton ou lorsqu'on fait entrée sur le clavier 

boutonEnvoyer.addEventListener("click", envoyerMessage);

textarea.addEventListener("keypress", function(e){
    if(e.key === "Enter"){
        e.preventDefault();
        envoyerMessage();
    }
});

function envoyerMessage(){

    const message = textarea.value.trim();
    if(message === "") return;

    afficherMessage(message, "user");
    textarea.value = "";

    reponseBot(message);
}


//la fonction qui se charge de récupérer le conseil associé au symptôme que l'utilisatrice aurait saisi dans son message; on intègre aussi une réponse aléatoire dans le cas d'un message social

function reponseBot(messageUtilisateur){
    const typing = document.createElement("div");
    typing.className = "message-bot";
    typing.textContent = "...";
    zoneChat.appendChild(typing);

    // Vérifier si le message est social
    const reponseSociale = verifierMessageSocial(messageUtilisateur);
    if(reponseSociale){
        
        setTimeout(() => {
            typing.remove();
            afficherMessage(reponseSociale,"bot");
        }, 500); 
        return; 
    }

    // Sinon, on continue avec le fetch pour les symptômes
    fetch("../php/symptomes.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`message=${encodeURIComponent(messageUtilisateur)}`
    })
    .then(res => res.json())
    .then(data => {
        typing.remove();
        const intro = randomPhrase(phrasesIntroConseil);
        const fin = randomPhrase(phrasesFinConseil);
        const messageFinal = `${intro}\n${data.reply}\n${fin}`;
        afficherMessage(messageFinal,"bot");
    })
    .catch(() => {
        typing.remove();
        afficherMessage("Erreur de connexion au serveur.","bot");
    });
}


/*pour rendre les pages "actives"*/
const currentPage = window.location.pathname.split("/").pop();
const links = document.querySelectorAll(".sidebar a");

links.forEach(link => {
    if(link.getAttribute("href") === currentPage){
        link.parentElement.classList.add("active");
    }
});

