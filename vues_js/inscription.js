// ===============================
// BabyMama – JS Page Inscription
// ===============================

// Récupération des éléments
const form = document.querySelector('.form');
const inputs = document.querySelectorAll('.form input');
const btn = document.querySelector('.btn');

// Empêcher le rechargement de la page
btn.addEventListener('click', function (e) {
  e.preventDefault();

  let isValid = true;

  // Vérification des champs
  inputs.forEach(input => {
    if (input.value.trim() === '') {
      input.style.border = '2px solid #E170A8';
      isValid = false;
    } else {
      input.style.border = 'none';
    }
  });

  // Si tout est OK
  if (isValid) {
    alert('Inscription réussie 💕 Bienvenue sur BabyMama');
    form.reset();
  }
});

// Effet focus doux
inputs.forEach(input => {
  input.addEventListener('focus', () => {
    input.parentElement.style.boxShadow =
      '0 0 0 2px rgba(225, 112, 168, 0.3)';
  });

  input.addEventListener('blur', () => {
    input.parentElement.style.boxShadow =
      '0 4px 10px rgba(0,0,0,0.05)';
  });
});
