// User System functions

async function logIn(){
  if(!checkEmpty('#login', 'input')){ return false;}
  toggleButton('#login', true);
  loadAnimation("#login", true);

  const userInput = openWindow.querySelector("#name");
  const pwdInput = openWindow.querySelector("#pwd");
  
  // Fetch starts
  const data = {
    op: "login",
    user: userInput.value,
    pwd: pwdInput.value,
  };
  const url = 'controllers/users.controller.php';
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    switch (result) {
      case "user_doesnt_exist": 
        message("El usuario no existe", "error"); 
        userInput.classList.add('error'); 
        break;
      case "wrong_password": 
        message("Usuario o contraseña incorrectos", "error"); 
        userInput.classList.add('error');
        pwdInput.classList.add('error');
        break;
      case "access_accepted":
        window.location.href='home';
        break;
    }
    toggleButton('#login', false);
    loadAnimation("#login", false);
  } else {
    console.error('Error al iniciar sesión:', response.statusText);
  }
}
async function signUp(){
  if(!checkEmpty('#signup', 'input')){return false;}

  const openWindow = document.getElementById('signup');
  const userInput = openWindow.querySelector("#email");
  const pwdInput = openWindow.querySelector("#pwdsignup");
  const pwdRepeatInput = openWindow.querySelector("#pwdrepeat");

  if(pwdInput.value != pwdRepeatInput.value) {
    pwdInput.classList.add('error');
    pwdRepeatInput.classList.add('error');
    message("Las contraseñas no son iguales", "error");
    return false;
  }

  pwdInput.classList.remove('error');
  pwdRepeatInput.classList.remove('error');

  var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!regex.test(userInput.value)) {
    message("El correo no es valido", "error");
    userInput.classList.add('error');
    return false;
  }

  pwdInput.classList.remove('error');
  pwdRepeatInput.classList.remove('error');
  
  toggleButton('#signup', true);
  loadAnimation("#signup", true);

  // Fetch starts
  const data = {
    op: "signup",
    email: userInput.value,
    pwd: pwdInput.value,
  };
  const url = 'controllers/users.controller.php';
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    switch (result) {
      case "user_already_exists":
        message("El usuario ya existe", "error");
        userInput.classList.add('error');
        break;
      case "access_accepted":
        window.location.href='home';
        break;
      default:
        message("Hubo un error", "error");
    }
    toggleButton('#signup', false);
    loadAnimation("#signup", false);
  } else {
    console.error('Error al registrarse:', response.statusText);
  }
}

async function getUserData(){
  const data = {
    op: "getUserData",
  };
  const url = 'controllers/users.controller.php';
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    if(!result){
      message("Hubo un error", "error");
      return false;
    }
    
    var id = result.id;
    var name = result.name;
    var email = result.email;

    document.getElementById("response-account-id").textContent = id;
    document.getElementById("response-account-email").textContent = email;
    document.getElementById("modify-account-username").value = name;
  }
}

async function modifyUserData(){
  const parent = "#window-account";
  if(!checkEmpty(parent, "INPUT")){return;}

  toggleButton(parent, true);
  loadAnimation(parent, true);

  var name = document.getElementById("modify-account-username");

  // Fetch starts
  const data = {
    op: "modifyUserData",
    name: name.value,
  };
  const url = 'controllers/users.controller.php';
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    toggleButton(parent, false);
    loadAnimation(parent, false);

    if(!result){
      message("Hubo un error", "error");
      return false;
    }
    if(result === "user_already_exists"){
      message("Nombre de usuario ya en uso", "error");
      name.classList.add('error');
      return false;
    }
    message("Datos modificados", "success");
    toggleWindow();
  }
}

async function saveUserName(){
  const parent = "#parent-no-name";
  if(!checkEmpty(parent, "INPUT")){return;}

  toggleButton(parent, true);
  loadAnimation(parent, true);

  var name = document.getElementById("set-account-username");

  // Fetch starts
  const data = {
    op: "modifyUserData",
    name: name.value,
  };
  const url = 'controllers/users.controller.php';
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    toggleButton(parent, false);
    loadAnimation(parent, false);

    if(!result){
      message("Hubo un error", "error");
      return false;
    }
    if(result === "user_already_exists"){
      message("Nombre de usuario ya en uso", "error");
      name.classList.add('error');
      return false;
    }
    message("Datos modificados", "success");
    toggleWindow();
  }
}