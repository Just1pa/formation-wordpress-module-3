jQuery(document).ready(function($) {
// Configuration de Flatpickr, cela permet d'ajouter Flatpickr + de récupérer la valeur sélectionnée dans le champ hidden
var flatpickrConfig = {
enableTime: true,
dateFormat: 'dd-mm-YYYY',
};
// Initialisation de Flatpickr pour la metabox
$('#evenement_metabox_date').flatpickr({
        onChange: function(selectedDates, dateStr, instance) {
            $('#evenement_metabox_date_hidden').val(dateStr);
            console.log(dateStr);
        }
    });
});
