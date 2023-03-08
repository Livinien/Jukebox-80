
// ANIMATION DU COEUR POUR LE LIKE D'UNE MUSIQUE

const heart = document.querySelectorAll('.js-heart');
// Mettre sur "false" quand l'utilisateur n'a pas selectionné le coeur
let liked = false;


// Créer un onclick événement
function favoris(index) {
	// Vérifier si l'utilisateur a aimé
	liked = !liked; // Retourner la variable
	
	// Cibler l'élément de l'événement à effectué
	const target = heart[index];
	
	if (!target.classList.contains("liked")) {
		// Cliquer pour ajouter le coeur plein en rouge
		target.classList.remove('far');
		target.classList.add('fas', 'pulse', 'liked');
	} else {
		// Cliquer pour ajouter le coeur vide
		target.classList.remove('fas', 'liked');
		target.classList.add('far');
	}
	
	// Mettre fin à l'animation "pulse"
	heart[index].addEventListener('animationend', (event) => {
		event.currentTarget.classList.remove('pulse');
		
	})
}


