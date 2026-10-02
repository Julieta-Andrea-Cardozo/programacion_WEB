// Barismo & Café — interacciones del sitio

document.addEventListener("DOMContentLoaded", () => {
  const CLAVE_CARRITO = "barismo-carrito";

  const leerCarrito = () => {
    try {
      return JSON.parse(localStorage.getItem(CLAVE_CARRITO)) || [];
    } catch {
      return [];
    }
  };

  const actualizarContador = (carrito) => {
    document.querySelectorAll("[data-carrito-contador]").forEach((el) => {
      el.textContent = carrito.length;
    });
    const mensaje = document.querySelector("[data-carrito-mensaje]");
    if (mensaje) {
      mensaje.textContent = carrito.length
        ? `Tenés ${carrito.length} producto(s) en el carrito: ${carrito.join(", ")}.`
        : "Tu carrito está vacío.";
    }
  };

  actualizarContador(leerCarrito());

  document.querySelectorAll("[data-agregar]").forEach((boton) => {
    boton.addEventListener("click", () => {
      const carrito = [...leerCarrito(), boton.dataset.agregar];
      localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));
      actualizarContador(carrito);
      boton.textContent = "Agregado ✓";
      setTimeout(() => {
        boton.textContent = "Agregar";
      }, 1500);
    });
  });

  const formulario = document.getElementById("form-contacto");
  if (formulario) {
    formulario.addEventListener("submit", (evento) => {
      evento.preventDefault();
      const ok = formulario.querySelector("[data-form-ok]");
      if (!formulario.checkValidity()) {
        formulario.classList.add("was-validated");
        ok.classList.add("d-none");
        return;
      }
      formulario.classList.remove("was-validated");
      formulario.reset();
      ok.classList.remove("d-none");
    });
  }

  document.querySelectorAll("[data-anio]").forEach((el) => {
    el.textContent = new Date().getFullYear();
  });
});
