document.addEventListener('DOMContentLoaded', () => {
    
    // 1. GESTION DE LA NAVIGATION (SIDEBAR)
    const menuItems = document.querySelectorAll('.nav-sidebar li');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            // Retirer la classe 'active' de tous les éléments
            menuItems.forEach(el => el.classList.remove('active'));
            
            // Ajouter la classe 'active' à l'élément cliqué
            item.classList.add('active');

            // Simulation de redirection selon le texte de l'onglet
            const page = item.innerText.trim().toLowerCase();
            console.log("Navigation vers : " + page);
            
            // Exemple : if(page === 'profil') window.location.href = 'profil.html';
        });
    });

    // 2. BOUTONS RÉSUMÉ (SYMPTÔMES & RAPPELS)
    const btnSymptomes = document.querySelector('.cards-row .card-btn:first-child');
    const btnRappels = document.querySelector('.cards-row .card-btn:last-child');

    if (btnSymptomes) {
        btnSymptomes.addEventListener('click', () => {
            window.location.href = 'symptomes.html';
        });
    }

    if (btnRappels) {
        btnRappels.addEventListener('click', () => {
            window.location.href = 'rappels.html';
        });
    }

    // 3. BOUTONS D'ACTION (BAS DE PAGE)
    const btnAddSymptom = document.querySelector('.action-white:nth-child(1)');
    const btnContactDoc = document.querySelector('.action-white:nth-child(2)');

    btnAddSymptom.addEventListener('click', () => {
        alert("Ouverture du formulaire d'ajout de symptômes...");
    });

    btnContactDoc.addEventListener('click', () => {
        // Simule un appel ou l'ouverture d'une messagerie
        window.location.href = 'tel:+33123456789'; 
    });

});