document.addEventListener("DOMContentLoaded", () => {
  const today   = dateToYMD(new Date());
  const $submit = document.querySelector(".find-button");

  var dateOK  = false;


  const getCheckinValidation = (checkin, checkout, today) => {
    if (checkin!== "" && checkin < today) {
      // List page Error
      document.getElementById("error").innerHTML = "Cannot select a date in the past.";
      document.getElementById("error-mob").innerHTML = "Cannot select a date in the past.";

      dateOK  = false;
    } else if (checkout!== "" && checkout < today) {
      document.getElementById("error").innerHTML = "Cannot select a date in the past.";
      document.getElementById("error-mob").innerHTML = "Cannot select a date in the past.";

      dateOK  = false;
    }else if (checkin!== "" && checkout!== "" && checkin > checkout) {
      document.getElementById("error").innerHTML = "Checkout date is greater than Checkin date.";
      document.getElementById("error-mob").innerHTML = "Checkout date is greater than Checkin date.";

      dateOK  = false;
    } else if(checkin!== "" && checkout!== ""){
      document.getElementById("error").innerHTML = "";
      document.getElementById("error-mob").innerHTML = "";

      dateOK  = true;
    }
  };

  const checkinBtn = () => {
    if (dateOK) {
      $submit.disabled = false;
    } else {
      $submit.disabled = true;
    }
  };


  $("#Checkin-checkout").on("change",function(){
    const $checkin = document.getElementById("check_in_date").value;
    const $checkout = document.getElementById("check_out_date").value;
    getCheckinValidation($checkin, $checkout, today);

    checkinBtn();
  });

  $("#Checkin-checkout-mob").on("change",function(){
    const $checkin_mob = document.getElementById("check_in_date-mob").value;
    const $checkout_mob = document.getElementById("check_out_date-mob").value;
    getCheckinValidation($checkin_mob, $checkout_mob, today);

    checkinBtn();
  });


  function dateToYMD(date) {
      var d = date.getDate();
      var m = date.getMonth() + 1; //Month from 0 to 11
      var y = date.getFullYear();
      return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
  };
});
