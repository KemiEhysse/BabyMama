// Récupérer les paramètres dans l'URL
const urlParams = new URLSearchParams(window.location.search);

// Extraire le token
const token = urlParams.get('token');

// Sélectionner l'input hidden
const tokenInput = document.getElementById('token');

// Vérifier si le token existe
if (token && tokenInput) {
    tokenInput.value = token;
} else {
    // Si pas de token alors le lien est invalide
    alert("Lien de réinitialisation invalide.");
    window.location.href = "../vues/login.html"; // ne pas  oublier d'adapter le lien en foncion de la poisition du fichier 
}