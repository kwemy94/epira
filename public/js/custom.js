function ControlRequiredFields(inputs = $('.required')) {
    let success = true;
    console.log('Nombre de champ requis : '+inputs.length);

    // Réinitialiser toutes les bordures de tab-pane
    $('.tab-pane').removeClass('tab-error');

    for (let i = 0; i < inputs.length; i++) {
        if ($(inputs[i]).val() == null || $(inputs[i]).val().trim() == '') { // trim permet d'enlever les tabulation inutile sur un champ
            $(inputs[i]).addClass('error-field');
            success = false;
        } else {
            $(inputs[i]).removeClass('error-field');
        }
    }

    return success;
}


function ControlRequiredFields2(inputs = $('.required')) {
    let success = true;
    console.log('Nombre de champ requis : ' + inputs.length);

    // Réinitialiser toutes les bordures de tab-pane
    $('.tab-pane').removeClass('tab-error');

    // Parcourir tous les champs requis
    for (let i = 0; i < inputs.length; i++) {
        const input = $(inputs[i]);
        const value = input.val() ? input.val().trim() : '';

        if (value === '') {
            input.addClass('error-field');
            success = false;

            // Trouver le tab-pane parent du champ et lui ajouter une bordure rouge
            const tabPane = input.closest('.tab-pane');
            if (tabPane.length) {
                tabPane.addClass('tab-error');
            }

        } else {
            input.removeClass('error-field');
        }
    }

    // Si un tab a une erreur, on le surligne aussi dans le header (onglet)
    $('.tab-error').each(function () {
        const id = $(this).attr('id');
        const tabLink = $('a[href="#' + id + '"]');
        tabLink.addClass('tab-link-error');
    });

    return success;
}



async function postData(url = "", data, method = "POST") {
    // Default options are marked with *

    const response = await fetch(url, {
        method: method, // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": $('input[name="_token"]').val(),
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });

    return response.json(); // parses JSON response into native JavaScript objects
}