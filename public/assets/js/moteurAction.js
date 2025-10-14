document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".moteurcard");
    const editBtn = document.getElementById("editMoteur");
    const deleteBtn = document.getElementById("deleteMoteur");

    //  Clique sur une carte → redirection
    cards.forEach(card => {
        card.addEventListener("click", (e) => {
            
             // Empêche le clic sur la checkbox de déclencher la redirection
            if (e.target.classList.contains("moteur-checkbox")) {
                e.stopPropagation();
                return;
            }
          
            const matricule = card.getAttribute("data-matricule");
            if (matricule) {
                 console.log("matricule not retrieved");
                window.location.href = `/GMOT/public/handlers/displayhandle.php?matricule=${encodeURIComponent(matricule)}`;
            }
        });
    });

    //  Fonction pour récupérer les moteurs cochés
    function getSelectedMotors() {
        const checked = document.querySelectorAll(".moteur-checkbox:checked");
        return Array.from(checked).map(cb => cb.value);
    }

    // Bouton Modifier
    if (editBtn) {
        editBtn.addEventListener("click", (e) => {
            e.preventDefault();
            const selected = getSelectedMotors();

            if (selected.length === 0) {
                alert("Veuillez sélectionner un moteur à modifier.");
            } else if (selected.length > 1) {
                alert("Vous ne pouvez modifier qu’un seul moteur à la fois.");
            } else {
                window.location.href = `/GMOT/public/handlers/editmoteur.php?matricule=${encodeURIComponent(selected[0])}`;
            }
        });
    }

    //  Bouton Supprimer
    if (deleteBtn) {
        deleteBtn.addEventListener("click", (e) => {
            e.preventDefault();
            const selected = getSelectedMotors();

            if (selected.length === 0) {
                alert("Veuillez sélectionner au moins un moteur à supprimer.");
                return;
            }

            if (!confirm(`Voulez-vous vraiment supprimer ${selected.length} moteur(s) ?`)) return;

            // Send selected motors to PHP via POST
            const form = document.createElement("form");
            form.method = "POST";
            form.action = "/GMOT/public/handlers/deletemoteur.php";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "motors";
            input.value = JSON.stringify(selected);

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        });
    }
});
