document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementsByClassName('contactlink'); // Première occurrence de la classe 'myBtn'

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    Array.from(btn).forEach((el) => {
        el.onclick = function() {
            modal.style.display = "block";
        }
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
} )

jQuery(document).ready(function($) {
    function loadPhotos(page = 1) {
        let category = $('#category-filter').val();
        let format = $('#format-filter').val();
        let dateOrder = $('#date-order').val() || 'DESC'; // Valeur par défaut pour le tri

        console.log("Filtres appliqués:", { category, format, dateOrder, page });

        $.ajax({
            url: child_style_js.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: category,
                format: format,
                date_order: dateOrder,
                page: page,
            },
            success: function(response) {
                console.log('Réponse AJAX reçue:', response);

                if (response.success) {
                    if (page === 1) $('.photo-grid').empty();
                    $('.photo-grid').append(response.data.content);

                    if (response.data.photos_loaded >= response.data.total_photos) {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').data('page', page + 1);
                        $('#load-more').show();
                    }
                } else {
                    console.log('Aucune photo trouvée.');
                    $('#load-more').hide();
                }
            },
            error: function(error) {
                console.log('Erreur AJAX', error);
            }
        });
    }

    $('#category-filter, #format-filter, #date-order').on('change', function() {
        loadPhotos(1);
    });

    $('#load-more').on('click', function() {
        let page = $(this).data('page') || 1;
        loadPhotos(page);
    });
});


//Récupération Ref Photo
jQuery(document).ready(function($) {
    $('.contactlink').on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut de l'ancre
        var refPhoto = $(this).data('ref-photo');
        $('input[name="your-subject"]').val(refPhoto);
        $('#myModal').fadeIn();
    });

    $('.close-button').on('click', function() {
        $('#myModal').fadeOut();
    });

    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').fadeOut();
        }
    });
});

