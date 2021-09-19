  document.addEventListener("click", function(){
    const $submit = document.querySelector("#review-button");
    var getSelectedValue = document.querySelector( 'input[name="rate"]:checked');

    if(getSelectedValue != null) {
      $submit.disabled = false;
    } else {
      $submit.disabled = true;
    };
});
