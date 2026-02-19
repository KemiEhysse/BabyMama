//on sélectionne le formulaire par son id
const form = document.querySelector("#form");  

//on écoute la soumission
form.addEventListener("submit", function(e){
    e.preventDefault();
});

//on récupère l'id' de l'email et du mot de passe
const email = document.querySelector("#email");
const mot_de_passe = document.querySelector("#mot_de_passe");


//on vérifie ensuite les champs renseignés et on empêche l'envoi s'ils sont vides 
if(email.value === "" || mot_de_passe.value === ""){
    alert("Veuillez remplir tous les champs.")
    return;
}

// on envoie les données au backend et on fait la redirection selon que le rôle(admin ou utilisatrice simple)

fetch("login.php", {  // ne pas oublier de remplacer par le chemin réel vers login.php
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `email=${encodeURIComponent(email)}&mot_de_passe=${encodeURIComponent(mot_de_passe)}`
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            // redirection selon le rôle
            if(data.role === "admin"){
                window.location.href = "admin_dashboard.html"; // on doit remplacer par la redirection vers la page de l'admin( c'est Précieuse qui a fait)
            } else {
                window.location.href = "accueil.html"; // remplacer par la page d'accueil de l'utilisatrice(toujours Précieuse)
            }
        } else {
            // si la connexion échoue alors
            alert(data.message || "Email ou mot de passe incorrect.");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur de connexion au serveur.");
    });
