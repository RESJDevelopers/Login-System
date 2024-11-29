document.addEventListener("DOMContentLoaded", function () {
  const base_url = "/login_system/";
  const registerForm = document.getElementById("registerForm");
  const loginForm = document.getElementById("loginForm");
  const usernameInput = document.getElementById("username");
  const emailInput = document.getElementById("email");
  const phoneInput = document.getElementById("phone");
  const searchInput = document.getElementById("search");

  if (registerForm) {
    if (usernameInput) {
      usernameInput.addEventListener("input", function () {
        const username = usernameInput.value.trim();
        if (username.length > 3) {
          fetch(`${base_url}auth/checkUsername?username=${username}`)
            .then((response) => response.text())
            .then((data) => {
              const usernameMessage =
                document.getElementById("usernameMessage");
              if (!usernameMessage) {
                const messageElement = document.createElement("p");
                messageElement.id = "usernameMessage";
                usernameInput.after(messageElement);
              }
              document.getElementById("usernameMessage").innerText = data;
            })
            .catch((error) => console.error("Error:", error));
        } else {
          const usernameMessage = document.getElementById("usernameMessage");
          if (usernameMessage) {
            usernameMessage.innerText = "";
          }
        }
      });
    }

    if (emailInput) {
      emailInput.addEventListener("input", function () {
        const email = emailInput.value.trim();
        if (email.length > 5) {
          fetch(`${base_url}auth/checkEmail?email=${email}`)
            .then((response) => response.text())
            .then((data) => {
              const emailMessage = document.getElementById("emailMessage");
              if (!emailMessage) {
                const messageElement = document.createElement("p");
                messageElement.id = "emailMessage";
                emailInput.after(messageElement);
              }
              document.getElementById("emailMessage").innerText = data;
            })
            .catch((error) => console.error("Error:", error));
        } else {
          const emailMessage = document.getElementById("emailMessage");
          if (emailMessage) {
            emailMessage.innerText = "";
          }
        }
      });
    }

    if (phoneInput) {
      phoneInput.addEventListener("input", function () {
        phoneInput.value = phoneInput.value.replace(/[^0-9]/g, "").slice(0, 8);
      });
    }

    registerForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(registerForm);

      const password = formData.get("password");
      const confirmPassword = formData.get("confirm_password");
      if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden");
        return;
      }

      const phone = formData.get("phone");
      if (phone.length !== 8 || phone.startsWith("0")) {
        alert("El teléfono debe tener 8 dígitos y no puede comenzar con 0");
        return;
      }

      fetch(`${base_url}auth/handleRegister`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          alert(data);
          if (data.includes("Registro exitoso")) {
            window.location.href = `${base_url}auth/login`;
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  }

  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(loginForm);

      fetch(`${base_url}auth/handleLogin`, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "error") {
            alert(data.message);
          } else {
            if (data.role_id == 1) {
              window.location.href = `${base_url}user/dashboard`;
            }
            if (data.role_id == 2) {
              window.location.href = `${base_url}admin/dashboard`;
            }
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  }

  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const query = searchInput.value.trim();
      if (query.length > 2) {
        $.ajax({
          url: `${base_url}admin/searchUsers`,
          method: "GET",
          data: { query: query },
          success: function (response) {
            const users = JSON.parse(response);
            const searchResults = document.getElementById("search-results");
            searchResults.innerHTML = "";
            users.forEach((user) => {
              const userElement = document.createElement("div");
              userElement.classList.add("user-result");
              userElement.innerHTML = `
                              <p>ID: ${user.id}</p>
                              <p>Nombre de Usuario: ${user.username}</p>
                              <p>Correo Electrónico: ${user.email}</p>
                              <p>Rol: ${
                                user.role_id == 1 ? "Usuario" : "Administrador"
                              }</p>
                              <form action="${base_url}admin/updateRole" method="POST">
                                  <input type="hidden" name="user_id" value="${
                                    user.id
                                  }">
                                  <select name="role_id">
                                      <option value="1" ${
                                        user.role_id == 1 ? "selected" : ""
                                      }>Usuario</option>
                                      <option value="2" ${
                                        user.role_id == 2 ? "selected" : ""
                                      }>Administrador</option>
                                  </select>
                                  <button type="submit">Actualizar</button>
                              </form>
                              <hr>
                          `;
              searchResults.appendChild(userElement);
            });
          },
          error: function (error) {
            console.error("Error:", error);
          },
        });
      } else {
        document.getElementById("search-results").innerHTML = "";
      }
    });
  }
});
