document.getElementById('registerForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const data = new FormData(form);
  const msg = document.getElementById('message');

  msg.textContent = "Procesando...";
  msg.className = "alert";

  try {
    const res = await fetch('registrar.php', { method: 'POST', body: data });
    const json = await res.json();

    if (json.success) {
      msg.textContent = json.message;
      msg.classList.add('success');
      form.reset();
    } else {
      msg.textContent = json.message;
      msg.classList.add('error');
    }
  } catch (err) {
    msg.textContent = "Error de conexión al servidor.";
    msg.classList.add('error');
  }
});


// script.js (updated version)
document.addEventListener("DOMContentLoaded", () => {
  const fullname = document.getElementById("fullname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const titleInput = document.getElementById("heroTitle");
  const subheading = document.getElementById("heroSubheading");
  const passtime = document.getElementById("passtime");
  const btn = document.getElementById("heroBtn");

  if (fullname && email && password && passtime) {
    const fields = [
      {
        input: fullname,
        validator: value => value.trim().length >= 3,
        message: "Nombre debe tener al menos 3 caracteres."
      },
      {
        input: email,
        validator: value => /^[^\s@]+@[a-zA-Z]+$/.test(value),
        message: "Debe contener un @ seguido de letras."
      },
      {
        input: password,
        validator: value => value.length >= 6,
        message: "Contraseña mínima de 6 caracteres."
      },
      { 
        input: passtime,
        validator: value => value.length >= 3,
        message: "Debe ser un pasatiempo válido."
      }
    ];

    const registerButton = document.querySelector("button[type='submit']");
    registerButton.disabled = true;
    registerButton.style.opacity = "0.6";
    registerButton.style.cursor = "not-allowed";

    const validState = { fullname: false, email: false, password: false };

    const updateButtonState = () => {
      const allValid = Object.values(validState).every(Boolean);
      registerButton.disabled = !allValid;
      registerButton.style.opacity = allValid ? "1" : "0.6";
      registerButton.style.cursor = allValid ? "pointer" : "not-allowed";
    };

    fields.forEach(({ input, validator, message }) => {
      const validationBox = input.parentElement.querySelector(".validation-box");

      input.addEventListener("input", () => {
        const value = input.value.trim();
        const isValid = validator(value);
        validationBox.textContent = isValid ? "Válido ✓" : message;
        validationBox.classList.toggle("valid", isValid);
        validationBox.classList.toggle("invalid", !isValid);
        validState[input.id] = isValid;
        updateButtonState();
      });
    });

    const form = document.querySelector("form");
    form.addEventListener("submit", e => {
      e.preventDefault();
      if (!registerButton.disabled) {
        alert("¡Registro exitoso! Redirigiendo a la página principal...");
        window.location.href = "LP.html"; // redirect to Landing Page
      }
    });
  }

  // === LOGIN PAGE ===
  const pageTitle = document.title.toLowerCase();
  if (pageTitle.includes("login")) {
    const loginButton = document.querySelector("button[type='submit']");
    if (loginButton) {
      loginButton.disabled = false;
      loginButton.style.opacity = "1";
      loginButton.style.cursor = "pointer";

      const form = document.querySelector("form");
      form.addEventListener("submit", e => {
        e.preventDefault();
        // Optional: add actual validation here if desired
        alert("Inicio de sesión exitoso. Redirigiendo a la página principal...");
        window.location.href = "LP.html";
      });
    }
  }


  titleInput.addEventListener("input", () => {
  });

  btn.addEventListener("click", () => {
    alert(`Title: ${titleInput.value}`);
  });
});
