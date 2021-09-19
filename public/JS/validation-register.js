document.addEventListener("DOMContentLoaded", () => {
  const $name = document.querySelector("#name");
  const $email = document.querySelector("#email");
  const $confirmemail = document.querySelector("#confirm-email");
  const $password = document.querySelector("#password");
  const $nameError = document.querySelector(".name-error");
  const $emailError = document.querySelector(".email-error");
  const $confirmemailError = document.querySelector(".confirm-email-error");
  const $passwordError = document.querySelector(".password-error");
  const $submit = document.querySelector("button");

  let nameIsValid = false;
  let emailIsValid = false;
  let confirmemailIsValid = false;
  let passwordIsValid = false;


  const getNameValidation = (name) => {
    if (name !== "" && name.length >= 8
    && /^[A-Za-z ]+$/.test(name)

    ){
      nameIsValid = true;
    } else {
      nameIsValid = false;
    }
  };

  const getEmailValidation = (email) => {
    if (
      email !== "" &&
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
    ) {
      emailIsValid = true;
    } else {
      emailIsValid = false;
    }
  };


  const getConfirmEmailValidation = (confirmemail) => {
    var valueemail = document.getElementById("email").value;
    if (confirmemail !== valueemail) {
      confirmemailIsValid = false;
    } else {
      confirmemailIsValid = true;
    }
  };

  const getpasswordValidation = (password) => {
    if (email !== "" && password.length > 8) {
      passwordIsValid = true;
    } else {
      passwordIsValid = false;
    }
  };


  const checkSigninBtn = () => {
    if (emailIsValid && passwordIsValid) {
      $submit.disabled = false;
    } else {
      $submit.disabled = true;
    }
  };



    $name.addEventListener("input", (e) => {
      getNameValidation(e.target.value);

      if (!nameIsValid) {
        $name.classList.add("is-invalid");
        $nameError.classList.remove("d-none");
      } else {
        $name.classList.remove("is-invalid");
        $nameError.classList.add("d-none");
      }

      checkSigninBtn();
    });


  $email.addEventListener("input", (e) => {
    getEmailValidation(e.target.value);

    if (!emailIsValid) {
      $email.classList.add("is-invalid");
      $emailError.classList.remove("d-none");
    } else {
      $email.classList.remove("is-invalid");
      $emailError.classList.add("d-none");
    }

    checkSigninBtn();
  });


  $confirmemail.addEventListener("input", (e) => {
    getConfirmEmailValidation(e.target.value);

    if (!confirmemailIsValid) {
      $confirmemail.classList.add("is-invalid");
      $confirmemailError.classList.remove("d-none");
    } else {
      $confirmemail.classList.remove("is-invalid");
      $confirmemailError.classList.add("d-none");
    }

    checkSigninBtn();
  });

  $password.addEventListener("input", (e) => {
    getpasswordValidation(e.target.value);

    if (!passwordIsValid) {
      $password.classList.add("is-invalid");
      $passwordError.classList.remove("d-none");
    } else {
      $password.classList.remove("is-invalid");
      $passwordError.classList.add("d-none");
    }

    checkSigninBtn();
  });

  $nameError.classList.add("d-none");
  $emailError.classList.add("d-none");
  $confirmemailError.classList.add("d-none");
  $passwordError.classList.add("d-none");
});
