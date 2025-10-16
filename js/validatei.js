function validar() {
    // Get form fields by their IDs
    const nombre = document.getElementById("nombre").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const usuario = document.getElementById("usuario").value.trim();
    const clave = document.getElementById("clave").value;
    const telefono = document.getElementById("telefono").value.trim();

    // Basic validation
    if (nombre.length < 3) {
        alert("El nombre debe tener al menos 3 caracteres.");
        return false;
    }
    if (apellidos.length < 3) {
        alert("Los apellidos deben tener al menos 3 caracteres.");
        return false;
    }
    // Simple email validation
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        alert("Ingrese un correo electrónico válido.");
        return false;
    }
    if (usuario.length < 3) {
        alert("El usuario debe tener al menos 3 caracteres.");
        return false;
    }
    if (clave.length < 6) {
        alert("La contraseña debe tener al menos 6 caracteres.");
        return false;
    }
    // Optional: Validate phone (digits only, min 7 chars)
    if (telefono && !/^\d{7,}$/.test(telefono)) {
        alert("Ingrese un teléfono válido (solo números, mínimo 7 dígitos).");
        return false;
    }
    // All validations passed
    return true;
}


 async function checkConnection() {
            const loader = document.getElementById('loader');
            const statusIcon = document.getElementById('statusIcon');
            const statusMessage = document.getElementById('statusMessage');
            const continueBtn = document.getElementById('continueBtn');
            const retryBtn = document.getElementById('retryBtn');

            loader.style.display = 'block';
            statusIcon.classList.remove('show');
            statusMessage.textContent = 'Verificando conexión a la base de datos...';
            continueBtn.classList.remove('show');
            retryBtn.classList.remove('show');

            try {
                const response = await fetch('php/conexion.php');
                const data = await response.json();

                loader.style.display = 'none';

                if (data.success) {
                    statusIcon.innerHTML = '✓';
                    statusIcon.className = 'status-icon success show';
                    statusMessage.textContent = data.message;
                    continueBtn.classList.add('show');
                } else {
                    statusIcon.innerHTML = '✗';
                    statusIcon.className = 'status-icon error show';
                    statusMessage.textContent = data.message;
                    retryBtn.classList.add('show');
                }
            } catch (error) {
                loader.style.display = 'none';
                statusIcon.innerHTML = '✗';
                statusIcon.className = 'status-icon error show';
                statusMessage.textContent = 'Error al verificar la conexión';
                retryBtn.classList.add('show');
            }
        }
        

        window.onload = checkConnection;