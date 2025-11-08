
let actesList = @json($actes);
let medecinsList = @json($medecins);
let actesSelectionnes = [];

function ajouterActe() {
    const tbody = document.getElementById('actes-body');
    const index = actesSelectionnes.length;

    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <select name="actes[${index}][id]" class="form-control" onchange="updateTarifs(this, ${index})">
                <option value="">-- Choisir un acte --</option>
                ${actesList.map(a => `<option value="${a.id}">${a.name}</option>`).join('')}
            </select>
        </td>
        <td>
                <input type="number" name="actes[${index}][tarif]" class="form-control text-end" readonly placeholder="Tarif auto" />
        </td>
        </td>
        <td>
            <select name="actes[${index}][doctor_id]" class="form-control">
                <option value="">-- Sélectionner un médecin --</option>
                ${medecinsList.map(m => `<option value="${m.id}">${m.nom}</option>`).join('')}
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="supprimerActe(this)">×</button>
        </td>
    `;
    tbody.appendChild(row);
    actesSelectionnes.push({ id: null, tarif: null, doctor_id: null });
}

function supprimerActe(btn) {
    const row = btn.closest('tr');
    row.remove();
    calculerTotal();
}

function updateTarifs(select, index) {
    const acteId = select.value;
    const acte = actesList.find(a => a.id == acteId);
    const tarifInput = select.closest('tr').querySelector(`[name="actes[${index}][tarif]"]`);

    if (acte) {
        tarifInput.value = acte.tarif; // tarif direct depuis l’acte
    } else {
        tarifInput.value = '';
    }

    calculerTotal();
}

function setDefaultMedecin(select) {
    const medecinId = select.value;
    document.querySelectorAll('[name$="[doctor_id]"]').forEach(sel => {
        if (!sel.value) sel.value = medecinId;
    });
}

function calculerTotal() {
    let total = 0;
    document.querySelectorAll('[name$="[tarif]"]').forEach(sel => {
        const val = parseFloat(sel.value) || 0;
        total += val;
    });
    document.getElementById('total-montant').innerText = total;
}