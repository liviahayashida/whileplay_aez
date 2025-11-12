async function login() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const result = await apiRequest("auth&action=login", { email, password });

  if (result.success) {
    alert("Bem-vindo, " + result.user);
    window.location.href = "home.html";
  } else {
    alert(result.message);
  }
}

async function register() {
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const result = await apiRequest("auth&action=register", { name, email, password });

  if (result.success) {
    alert("Cadastro realizado!");
    window.location.href = "login.html";
  } else {
    alert("Erro ao cadastrar");
  }
}
