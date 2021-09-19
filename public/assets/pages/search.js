(function ($){
    $(document).on('submit', 'form.searchForm', function(e){
        // Stop default form behavior
        e.preventDefault();

        // Get form data
        const formData = $(this).serialize();

        // Ajax request
        $.ajax(
          'http://hotel.collegelink.localhost/public/ajax/search_results.php',
          {
            type: "GET",
            dataType: "html",
            data: formData
          }).done(function(result) {
            // Clear results container
            $('#results-container').html('');

            // Append results to container
            $('#results-container').append(result);

            // Push ulr state
            history.pushState({}, '', 'http://hotel.collegelink.localhost/public/list.php?'+formData);
          });
    });
})(jQuery);
