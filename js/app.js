// Barismo & Café — búsqueda de productos en vivo con Fetch API y JSON (TP9)

document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("form-busqueda");
  const inputBusqueda = document.getElementById("q");
  const selectCategoria = document.getElementById("tipo");
  const contenedorResultados = document.getElementById("resultados");
  const estado = document.querySelector("[data-estado-busqueda]");

  if (!formulario || !inputBusqueda || !contenedorResultados) {
    return;
  }

  const endpoint = formulario.dataset.api;
  const catalogoEstatico = document.querySelectorAll("[data-catalogo]");
  const categorias = { granos: "grano", insumos: "insumo" };
  let temporizador;
  let controlador;

  const formatoPrecio = (monto) => "$" + monto.toLocaleString("es-AR");
  const estrellas = (n) => "★".repeat(n) + "☆".repeat(5 - n);

  const mostrarCatalogo = (visible) => {
    catalogoEstatico.forEach((el) => {
      el.hidden = !visible;
    });
    contenedorResultados.hidden = visible;
  };

  const crear = (etiqueta, clase, texto) => {
    const el = document.createElement(etiqueta);
    if (clase) el.className = clase;
    // textContent (y no innerHTML) para que los datos de la base no puedan inyectar HTML.
    if (texto !== undefined) el.textContent = texto;
    return el;
  };

  const crearTarjeta = (producto) => {
    const columna = crear("div", "col-sm-6 col-lg-3");
    const tarjeta = crear("article", "card tarjeta");

    const imagen = crear("img");
    imagen.src = producto.imagen ? `img/${producto.imagen}` : "img/favicon.svg";
    imagen.alt = producto.nombre;
    imagen.width = 500;
    imagen.height = 500;
    imagen.loading = "lazy";

    const cuerpo = crear("div", "card-body p-3 d-flex flex-column");
    const puntaje = crear("p", "estrellas mb-1", estrellas(producto.estrellas));
    puntaje.setAttribute("aria-label", `${producto.estrellas} de 5 estrellas`);

    const pie = crear("div", "d-flex justify-content-between align-items-center mt-auto");
    const boton = crear("button", "btn btn-borde btn-sm", "Agregar");
    boton.type = "button";
    boton.dataset.agregar = producto.nombre;
    boton.setAttribute("aria-label", `Agregar ${producto.nombre} al carrito`);
    pie.append(crear("span", "precio fs-4", formatoPrecio(producto.precio)), boton);

    cuerpo.append(
      crear("p", "meta mb-1", producto.meta),
      crear("h2", "card-title h5 mb-1", producto.nombre),
      puntaje,
      crear("p", "small fst-italic", producto.notas),
      pie,
    );
    tarjeta.append(imagen, cuerpo);
    columna.append(tarjeta);
    return columna;
  };

  const renderizarResultados = (productos, termino) => {
    contenedorResultados.replaceChildren();
    if (productos.length === 0) {
      const vacio = crear("div", "col-12");
      vacio.append(
        crear("p", "alert alert-warning mb-0", `No encontramos productos para «${termino}».`),
      );
      contenedorResultados.append(vacio);
      return;
    }
    productos.forEach((producto) => contenedorResultados.append(crearTarjeta(producto)));
  };

  const buscar = async () => {
    const termino = inputBusqueda.value.trim();
    const categoria = categorias[selectCategoria?.value] || "";

    if (termino === "") {
      mostrarCatalogo(true);
      estado.textContent = "Los resultados se actualizan mientras escribís, sin recargar la página.";
      return;
    }

    // Cancela la petición anterior si el usuario sigue escribiendo.
    controlador?.abort();
    controlador = new AbortController();

    const parametros = new URLSearchParams({ q: termino });
    if (categoria) parametros.set("categoria", categoria);

    estado.textContent = "Buscando…";
    try {
      const respuesta = await fetch(`${endpoint}?${parametros}`, {
        headers: { Accept: "application/json" },
        signal: controlador.signal,
      });
      const json = await respuesta.json();

      if (!respuesta.ok || json.status !== "success") {
        throw new Error(json.message || `Error HTTP: ${respuesta.status}`);
      }

      renderizarResultados(json.data, termino);
      mostrarCatalogo(false);
      estado.textContent = `${json.total} producto(s) encontrados para «${termino}» (desde la base de datos).`;
    } catch (error) {
      if (error.name === "AbortError") return;
      console.error("Error al realizar la petición:", error);
      estado.textContent = `No se pudo completar la búsqueda: ${error.message}`;
    }
  };

  inputBusqueda.addEventListener("input", () => {
    clearTimeout(temporizador);
    temporizador = setTimeout(buscar, 300);
  });
  selectCategoria?.addEventListener("change", buscar);

  // Con JavaScript activo el formulario no recarga la página; sin JS sigue funcionando por GET.
  formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();
    clearTimeout(temporizador);
    buscar();
  });
});
