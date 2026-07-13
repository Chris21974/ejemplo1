const formulario = document.getElementById("formularioMembresia");
const formularioSeccion = document.getElementById("formularioSeccion");
const exitoSeccion = document.getElementById("exitoSeccion");
const errorBox = document.getElementById("errorBox");
const listaErrores = document.getElementById("listaErrores");
const btnVolver = document.getElementById("btnVolver");

const campos = {
    nombre: document.getElementById("nombre"),
    apellido: document.getElementById("apellido"),
    direccion1: document.getElementById("direccion1"),
    direccion2: document.getElementById("direccion2"),
    ciudad: document.getElementById("ciudad"),
    estado: document.getElementById("estado"),
    codigoPostal: document.getElementById("codigo_postal"),
    pais: document.getElementById("pais"),
    telefono: document.getElementById("telefono"),
    email: document.getElementById("email")
};

const patronNombre = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
const patronTelefono = /^\d{10}$/;
const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function limpiarErrores() {
    listaErrores.innerHTML = "";
    errorBox.classList.add("hidden");

    Object.values(campos).forEach((campo) => {
        campo.classList.remove("campo-error");
    });
}

function agregarError(mensaje, camposIncorrectos = []) {
    const elemento = document.createElement("li");
    elemento.textContent = mensaje;
    listaErrores.appendChild(elemento);

    camposIncorrectos.forEach((campo) => {
        campo.classList.add("campo-error");
    });
}

formulario.addEventListener("submit", function (evento) {
    evento.preventDefault();

    limpiarErrores();

    const valores = {
        nombre: campos.nombre.value.trim(),
        apellido: campos.apellido.value.trim(),
        direccion1: campos.direccion1.value.trim(),
        direccion2: campos.direccion2.value.trim(),
        ciudad: campos.ciudad.value.trim(),
        estado: campos.estado.value.trim(),
        codigoPostal: campos.codigoPostal.value.trim(),
        pais: campos.pais.value,
        telefono: campos.telefono.value.trim(),
        email: campos.email.value.trim()
    };

    let hayErrores = false;

    if (valores.nombre === "" || valores.apellido === "") {
        agregarError(
            "El nombre y el apellido son obligatorios.",
            [campos.nombre, campos.apellido]
        );

        hayErrores = true;
    }

    if (
        valores.nombre !== "" &&
        !patronNombre.test(valores.nombre)
    ) {
        agregarError(
            "En el campo Primer nombre solo se permiten letras y espacios.",
            [campos.nombre]
        );

        hayErrores = true;
    }

    if (
        valores.apellido !== "" &&
        !patronNombre.test(valores.apellido)
    ) {
        agregarError(
            "En el campo Apellido solo se permiten letras y espacios.",
            [campos.apellido]
        );

        hayErrores = true;
    }

    if (valores.direccion1 === "") {
        agregarError(
            "La dirección principal es obligatoria.",
            [campos.direccion1]
        );

        hayErrores = true;
    }

    if (
        valores.ciudad === "" ||
        valores.estado === "" ||
        valores.codigoPostal === "" ||
        valores.pais === ""
    ) {
        agregarError(
            "Por favor, completa todos los campos de ubicación.",
            [
                campos.ciudad,
                campos.estado,
                campos.codigoPostal,
                campos.pais
            ]
        );

        hayErrores = true;
    }

    if (valores.telefono === "") {
        agregarError(
            "El número de teléfono es obligatorio.",
            [campos.telefono]
        );

        hayErrores = true;
    } else if (!patronTelefono.test(valores.telefono)) {
        agregarError(
            "El teléfono debe contener exactamente 10 números.",
            [campos.telefono]
        );

        hayErrores = true;
    }

    if (valores.email === "") {
        agregarError(
            "La dirección de correo electrónico es obligatoria.",
            [campos.email]
        );

        hayErrores = true;
    } else if (!patronCorreo.test(valores.email)) {
        agregarError(
            "El formato del correo electrónico no es válido.",
            [campos.email]
        );

        hayErrores = true;
    }

    if (hayErrores) {
        errorBox.classList.remove("hidden");

        errorBox.scrollIntoView({
            behavior: "smooth",
            block: "center"
        });

        return;
    }

    formularioSeccion.classList.add("hidden");
    exitoSeccion.classList.remove("hidden");
});

btnVolver.addEventListener("click", function () {
    formulario.reset();
    limpiarErrores();

    exitoSeccion.classList.add("hidden");
    formularioSeccion.classList.remove("hidden");

    campos.nombre.focus();
});

campos.telefono.addEventListener("input", function () {
    campos.telefono.value = campos.telefono.value
        .replace(/\D/g, "")
        .slice(0, 10);
});