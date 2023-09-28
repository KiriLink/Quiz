const email = document.getElementById("logemail");
const password = document.getElementById("logpass");
const login = document.querySelector(".btn");
const ptxt = document.getElementById("pword-txt");
const etxt = document.getElementById("email-txt");
const Eerror = document.getElementById("email-error");
const perror = document.getElementById("password-error");
const input = document.querySelector(".form-style");
const container = document.querySelector(".container");
const esearch = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
const psearch = /[a-z]{8,32}/g;

login.addEventListener('click', (e) => {
  if(!password.value.match(psearch)){
   password.focus();
   e.preventDefault();
    password.style.borderColor = "#ec4846";
    ptxt.style.color = "#ec4846";
    perror.innerText = " - La constraseña de tener entre 8 a 32 caracteres";
  }
  else if(email.value === "" || !email.value.match(esearch)){
    email.focus();
    e.preventDefault();
    email.style.borderColor = "#ec4846";
    etxt.style.color = "#ec4846";
    Eerror.innerText = " - El correo institucional no es válido";
  }else{
    email.value = "";
    password.value = "";
    container.style.animation = "jump .3s linear";
    container.addEventListener('animationend', () => {
      container.style.display = "none";
      canvas.style.transform = "translate(0vw)";
     // setTimeout(() => {
        user.login = true;
      //}, 1000)
    })
  }
  setTimeout(() => {
    ptxt.style.color = "#919296";
    etxt.style.color = "#919296";
    perror.innerText = "";
    Eerror.innerText = "";
    email.style.borderColor = "";
    password.style.borderColor = "";
  }, 2500)
});

let user= {
  login: false
}

window.addEventListener('resize', function(){
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
})
