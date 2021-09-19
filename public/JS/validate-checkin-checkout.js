document.addEventListener("DOMContentLoaded", () => {
  const today   = dateToYMD(new Date());
  const $submit = document.querySelector("button");
  const $city = document.querySelector("#city").value;
  const $Error1 = document.querySelector(".error1");
  const $Error2 = document.querySelector(".error2");

  var dateOK  = false;
  var cityOK  = false;

  const getcityValidation = (city) => {
    if (city !== "") {
      cityOK  = true;
    } else {
      cityOK  = false;
    }
  };

  const getCheckinValidation = (checkin, checkout, today) => {
    if (checkin!== "" && checkin < today) {
      // List page Error
      // document.getElementById("error").innerHTML = "Cannot select a date in the past.";
      // document.getElementById("error-mob").innerHTML = "Cannot select a date in the past.";

      // Intex page error
      $Error1.classList.remove("d-none");
      $Error2.classList.add("d-none");
      dateOK  = false;
    } else if (checkout!== "" && checkout < today) {
      // document.getElementById("error").innerHTML = "Cannot select a date in the past.";
      // document.getElementById("error-mob").innerHTML = "Cannot select a date in the past.";

      $Error1.classList.remove("d-none");
      $Error2.classList.add("d-none");
      dateOK  = false;
    }else if (checkin!== "" && checkout!== "" && checkin > checkout) {
      // document.getElementById("error").innerHTML = "Checkout date is greater than Checkin date.";
      // document.getElementById("error-mob").innerHTML = "Checkout date is greater than Checkin date.";

      $Error2.classList.remove("d-none");
      $Error1.classList.add("d-none");
      dateOK  = false;
    } else if(checkin!== "" && checkout!== ""){
      // document.getElementById("error").innerHTML = "";
      // document.getElementById("error-mob").innerHTML = "";


      dateOK  = true;
      $Error2.classList.add("d-none");
      $Error1.classList.add("d-none");
    }
  };

  const checkinBtn = () => {
    if (dateOK && cityOK) {
      $submit.disabled = false;
    } else {
      $submit.disabled = true;
    }
  };


  $("#Checkin-checkout").on("change",function(){
    const $checkin = document.getElementById("check_in_date").value;
    const $checkout = document.getElementById("check_out_date").value;
    console.log($checkin);
    getCheckinValidation($checkin, $checkout, today);
    checkinBtn();
  });

$("#city").on("change",function(){
    const $city = document.querySelector("#city").value;
    getcityValidation($city);
    checkinBtn();
});


  $Error1.classList.add("d-none");
  $Error2.classList.add("d-none");

  function dateToYMD(date) {
      var d = date.getDate();
      var m = date.getMonth() + 1; //Month from 0 to 11
      var y = date.getFullYear();
      return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
  };
});
