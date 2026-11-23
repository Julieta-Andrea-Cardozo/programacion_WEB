// Barismo & Café — interacciones del sitio

document.addEventListener("DOMContentLoaded", () => {
  const CLAVE_CARRITO = "barismo-carrito";
  const formatoPrecio = (monto) => "$" + Number(monto).toLocaleString("es-AR");

  const leerCarrito = () => {
    try {
      const datos = JSON.parse(localStorage.getItem(CLAVE_CARRITO)) || [];
      return Array.isArray(datos) ? datos.filter((item) => item && typeof item === "object") : [];
    } catch {
      return [];
    }
  };

  const guardarCarrito = (carrito) => {
    localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));
    renderizarCarrito(carrito);
  };

  const cantidadTotal = (carrito) => carrito.reduce((suma, item) => suma + item.cantidad, 0);
  const importeTotal = (carrito) =>
    carrito.reduce((suma, item) => suma + item.precio * item.cantidad, 0);

  const panel = document.querySelector("[data-carrito]");
  const fondo = document.querySelector("[data-carrito-fondo]");
  const lista = document.querySelector("[data-carrito-lista]");
  const vacio = document.querySelector("[data-carrito-vacio]");
  const total = document.querySelector("[data-carrito-total]");
  const confirmacion = document.querySelector("[data-carrito-ok]");
  const toast = document.querySelector("[data-toast]");
  const base = (document.querySelector('link[rel="icon"]')?.getAttribute("href") || "").replace(
    "img/favicon.svg",
    "",
  );

  const crear = (etiqueta, clase, texto) => {
    const el = document.createElement(etiqueta);
    if (clase) el.className = clase;
    if (texto !== undefined) el.textContent = texto;
    return el;
  };

  const crearItem = (item, indice) => {
    const fila = crear("li", "flex gap-4 rounded-2xl border border-borde bg-white p-3");
    const imagen = crear("img", "h-20 w-20 flex-none rounded-xl object-cover");
    imagen.src = item.img ? `${base}img/${item.img}` : `${base}img/favicon.svg`;
    imagen.alt = "";

    const cuerpo = crear("div", "flex flex-1 flex-col");
    const titulo = crear("p", "font-titulo font-bold text-espresso", item.nombre);
    const unitario = crear("p", "meta", `${formatoPrecio(item.precio)} c/u`);

    const controles = crear("div", "mt-auto flex items-center justify-between");
    const cantidad = crear("div", "flex items-center rounded-full border border-borde");
    const menos = crear("button", "h-8 w-8 text-cafe hover:text-caramelo", "−");
    menos.type = "button";
    menos.dataset.carritoMenos = indice;
    menos.setAttribute("aria-label", `Quitar una unidad de ${item.nombre}`);
    const numero = crear("span", "w-6 text-center font-mono text-sm", String(item.cantidad));
    const mas = crear("button", "h-8 w-8 text-cafe hover:text-caramelo", "+");
    mas.type = "button";
    mas.dataset.carritoMas = indice;
    mas.setAttribute("aria-label", `Sumar una unidad de ${item.nombre}`);
    cantidad.append(menos, numero, mas);

    const subtotal = crear(
      "span",
      "font-titulo font-black text-espresso",
      formatoPrecio(item.precio * item.cantidad),
    );
    controles.append(cantidad, subtotal);

    const quitar = crear("button", "self-start text-suave hover:text-bordo", "✕");
    quitar.type = "button";
    quitar.dataset.carritoQuitar = indice;
    quitar.setAttribute("aria-label", `Quitar ${item.nombre} del carrito`);

    cuerpo.append(titulo, unitario, controles);
    fila.append(imagen, cuerpo, quitar);
    return fila;
  };

  const renderizarCarrito = (carrito) => {
    const unidades = cantidadTotal(carrito);
    document.querySelectorAll("[data-carrito-contador]").forEach((el) => {
      el.textContent = unidades;
    });

    const mensaje = document.querySelector("[data-carrito-mensaje]");
    if (mensaje) {
      mensaje.textContent = unidades
        ? `Tenés ${unidades} producto(s) en el carrito por ${formatoPrecio(importeTotal(carrito))}.`
        : "Tu carrito está vacío.";
    }

    if (!lista) return;
    lista.replaceChildren(...carrito.map(crearItem));
    lista.classList.toggle("hidden", carrito.length === 0);
    vacio.classList.toggle("hidden", carrito.length > 0);
    vacio.classList.toggle("flex", carrito.length === 0);
    total.textContent = formatoPrecio(importeTotal(carrito));
    document.querySelectorAll("[data-carrito-vaciar], [data-carrito-finalizar]").forEach((b) => {
      b.disabled = carrito.length === 0;
      b.classList.toggle("opacity-50", carrito.length === 0);
    });
  };

  const abrirCarrito = () => {
    panel.classList.remove("translate-x-full");
    panel.setAttribute("aria-hidden", "false");
    fondo.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
    panel.querySelector("[data-carrito-cerrar]").focus();
  };

  const cerrarCarrito = () => {
    panel.classList.add("translate-x-full");
    panel.setAttribute("aria-hidden", "true");
    fondo.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    confirmacion.classList.add("hidden");
  };

  let temporizadorToast;
  const mostrarToast = (texto) => {
    toast.textContent = texto;
    toast.classList.remove("opacity-0", "translate-y-4");
    clearTimeout(temporizadorToast);
    temporizadorToast = setTimeout(() => toast.classList.add("opacity-0", "translate-y-4"), 1800);
  };

  renderizarCarrito(leerCarrito());

  // Delegación de eventos: también funciona con las tarjetas que agrega app.js.
  document.addEventListener("click", (evento) => {
    const objetivo = evento.target;
    const agregar = objetivo.closest("[data-agregar]");

    if (agregar) {
      const carrito = leerCarrito();
      const nombre = agregar.dataset.agregar;
      const existente = carrito.find((item) => item.nombre === nombre);
      if (existente) {
        existente.cantidad += 1;
      } else {
        carrito.push({
          nombre,
          precio: Number(agregar.dataset.precio) || 0,
          img: agregar.dataset.img || "",
          cantidad: 1,
        });
      }
      guardarCarrito(carrito);
      mostrarToast(`${nombre} agregado al carrito`);
      agregar.textContent = "Agregado ✓";
      setTimeout(() => {
        agregar.textContent = "Agregar";
      }, 1500);
      return;
    }

    if (objetivo.closest("[data-carrito-abrir]")) return abrirCarrito();
    if (objetivo.closest("[data-carrito-cerrar]") || objetivo.closest("[data-carrito-fondo]")) {
      return cerrarCarrito();
    }

    const carrito = leerCarrito();
    const mas = objetivo.closest("[data-carrito-mas]");
    const menos = objetivo.closest("[data-carrito-menos]");
    const quitar = objetivo.closest("[data-carrito-quitar]");

    if (mas) {
      carrito[mas.dataset.carritoMas].cantidad += 1;
      guardarCarrito(carrito);
    } else if (menos) {
      const item = carrito[menos.dataset.carritoMenos];
      item.cantidad -= 1;
      guardarCarrito(item.cantidad > 0 ? carrito : carrito.filter((i) => i !== item));
    } else if (quitar) {
      carrito.splice(Number(quitar.dataset.carritoQuitar), 1);
      guardarCarrito(carrito);
    } else if (objetivo.closest("[data-carrito-vaciar]")) {
      guardarCarrito([]);
    } else if (objetivo.closest("[data-carrito-finalizar]") && carrito.length) {
      const importe = formatoPrecio(importeTotal(carrito));
      guardarCarrito([]);
      confirmacion.textContent = `¡Gracias por tu compra! Registramos tu pedido por ${importe}.`;
      confirmacion.classList.remove("hidden");
    }
  });

  document.addEventListener("keydown", (evento) => {
    if (evento.key === "Escape" && panel?.getAttribute("aria-hidden") === "false") cerrarCarrito();
  });

  window.addEventListener("storage", (evento) => {
    if (evento.key === CLAVE_CARRITO) renderizarCarrito(leerCarrito());
  });

  const botonMenu = document.querySelector("[data-menu-toggle]");
  const menu = document.getElementById("menuPrincipal");
  botonMenu?.addEventListener("click", () => {
    const abierto = menu.classList.toggle("hidden") === false;
    menu.classList.toggle("flex", abierto);
    botonMenu.setAttribute("aria-expanded", String(abierto));
  });

  document.addEventListener("click", (evento) => {
    document.querySelectorAll("[data-desplegable][open]").forEach((el) => {
      if (!el.contains(evento.target)) el.removeAttribute("open");
    });
  });

  document.querySelectorAll("[data-tabs]").forEach((grupo) => {
    const botones = grupo.querySelectorAll('[role="tab"]');
    botones.forEach((boton) => {
      boton.addEventListener("click", () => {
        botones.forEach((otro) => {
          const activo = otro === boton;
          otro.setAttribute("aria-selected", String(activo));
          otro.tabIndex = activo ? 0 : -1;
          document.getElementById(otro.getAttribute("aria-controls")).hidden = !activo;
        });
      });
    });
  });

  document.querySelectorAll("[data-desplegar]").forEach((boton) => {
    boton.addEventListener("click", () => {
      const destino = document.getElementById(boton.getAttribute("aria-controls"));
      const abierto = destino.hidden;
      destino.hidden = !abierto;
      boton.setAttribute("aria-expanded", String(abierto));
      boton.textContent = abierto ? "Cerrar nota ↑" : "Leer nota →";
    });
  });

  const formulario = document.getElementById("form-contacto");
  if (formulario) {
    formulario.addEventListener("submit", (evento) => {
      const ok = formulario.querySelector("[data-form-ok]");
      if (!formulario.checkValidity()) {
        evento.preventDefault();
        formulario.classList.add("was-validated");
        ok.classList.add("hidden");
        return;
      }
      if (formulario.hasAttribute("data-servidor")) {
        return;
      }
      evento.preventDefault();
      formulario.classList.remove("was-validated");
      formulario.reset();
      ok.classList.remove("hidden");
    });
  }

  document.querySelectorAll("[data-anio]").forEach((el) => {
    el.textContent = new Date().getFullYear();
  });
});
