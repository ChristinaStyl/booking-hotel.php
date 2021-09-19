(function ($){
    // Favorite
    $(document).on('submit', 'form.favoriteForm', function(e){

        // Stop default form behavior
        e.preventDefault();

        // Get form data
        const formData = $(this).serialize();

        // Ajax request
        $.ajax(
          'http://hotel.collegelink.localhost/public/ajax/room_favorite.php',
          {
            type: "POST",
            dataType: "json",
            data: formData
          }).done(function(result) {
             if (result.status){
               $('input[name=is_favorite]').val(result.is_favorite ? 1 : 0);
             } else {
               $('.fav_stars .heart ').toggleClass('selected', !result.is_favorite);
             }
          });
    });

    // Review
    $(document).on('submit', 'form.reviewForm', function(e){

        // Stop default form behavior
        e.preventDefault();

        // Get form data
        const formData = $(this).serialize();

        // Ajax request
        $.ajax(
          'http://hotel.collegelink.localhost/public/ajax/room_review.php',
          {
            type: "POST",
            dataType: "html",
            data: formData
          }).done(function(result) {
            // Append review to container
            $('#reviews-container').append(result);

            // Reset add review form
            $('form.reviewForm').trigger('reset');
          });
    });

})(jQuery);
