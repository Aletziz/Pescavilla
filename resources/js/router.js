let contenedor_principal = document.getElementById("main");

function getRoute(name) {
    if (window.AppRoutes && window.AppRoutes[name])
        return window.AppRoutes[name];

    const body = document.body;
    const key = `route-${name}`;
    if (body && body.dataset && body.dataset[key]) return body.dataset[key];

    if (name === "ueb") return "/ueb";
    if (name === "embalse") return "/embalse";
    if (name === "especie") return "/especie";

    return "/";
}

document.addEventListener("DOMContentLoaded", () => {
    contenedor_principal = document.getElementById("main");
    if (!contenedor_principal) {
        return;
    }

    const ruta_ueb = getRoute("ueb");
    const ruta_embalse = getRoute("embalse");
    const ruta_especie = getRoute("especie");

    // Detectar qué vista cargar basándose en la URL actual
    const currentPath = window.location.pathname;
    const contenidoActual = contenedor_principal.innerHTML.trim();
    const tieneContenido = contenidoActual && contenidoActual.length > 100;

    if (!tieneContenido) {
        // Si el contenedor está vacío, cargar según la URL actual
        if (currentPath === "/embalse" || currentPath.startsWith("/embalse/")) {
            cargarVista(currentPath, false);
        } else if (
            currentPath === "/especie" ||
            currentPath.startsWith("/especie/")
        ) {
            cargarVista(currentPath, false);
        } else if (currentPath === "/ueb" || currentPath.startsWith("/ueb/")) {
            cargarVista(currentPath, false);
        } else {
            // Solo cargar UEB por defecto si estamos en la raíz
            cargarVista(ruta_ueb);
        }
    } else {
        // Sincronizar el historial con el contenido actual
        if (window.history && currentPath !== "/") {
            window.history.replaceState({ path: currentPath }, "", currentPath);
        }
    }

    // Interceptar TODOS los clicks en enlaces internos (event delegation)
    document.addEventListener("click", (e) => {
        const link = e.target.closest('a[href^="/"]');

        if (link) {
            const href = link.getAttribute("href");

            // Verificar que sea una ruta interna válida
            if (href && href.startsWith("/") && !href.includes("#")) {
                e.preventDefault();
                cargarVista(href);
            }
        }
    });

    // Enlaces del sidebar desktop
    const btn_ueb = document.getElementById("link-ueb");
    const btn_embalse = document.getElementById("link-embalse");
    const btn_especie = document.getElementById("link-especie");

    // Enlaces del sidebar mobile
    const mobile_btn_ueb = document.getElementById("mobile-link-ueb");
    const mobile_btn_embalse = document.getElementById("mobile-link-embalse");
    const mobile_btn_especie = document.getElementById("mobile-link-especie");

    if (btn_ueb) {
        btn_ueb.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_ueb);
        });
    }

    if (btn_embalse) {
        btn_embalse.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_embalse);
        });
    }

    if (btn_especie) {
        btn_especie.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_especie);
        });
    }

    // Event listeners para el menú móvil
    if (mobile_btn_ueb) {
        mobile_btn_ueb.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_ueb);
        });
    }

    if (mobile_btn_embalse) {
        mobile_btn_embalse.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_embalse);
        });
    }

    if (mobile_btn_especie) {
        mobile_btn_especie.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(ruta_especie);
        });
    }

    // Manejar el botón "atrás" del navegador
    window.addEventListener("popstate", (e) => {
        const currentPath = window.location.pathname;

        // Cargar la vista pero sin agregar al historial (ya estamos navegando en el historial)
        cargarVista(currentPath, false);
    });
});

function cargarVista(ruta, actualizarHistorial = true) {
    if (!ruta) {
        return;
    }

    fetch(ruta, { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then((res) => {
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.text();
        })
        .then((html) => {
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;

            const mainUEB =
                tempDiv.querySelector("#contenedor") ||
                tempDiv.querySelector("#main");

            if (mainUEB) {
                contenedor_principal.innerHTML = mainUEB.innerHTML;

                // Actualizar la URL sin recargar la página
                if (actualizarHistorial && window.history) {
                    window.history.pushState({ path: ruta }, "", ruta);
                }

                // Actualizar el elemento activo del sidebar
                actualizarSidebarActivo(ruta);

                // Pequeño delay para asegurar que el DOM esté completamente renderizado
                setTimeout(() => {
                    // Reinicializar componentes de Bootstrap (dropdowns, tooltips, etc.)
                    initBootstrapComponents();

                    // Re-attach event listeners después de cargar nuevo contenido
                    attachDynamicEventListeners();

                    // Reinicializar funcionalidad de búsqueda
                    if (typeof window.initializeSearch === "function") {
                        window.initializeSearch();
                    }

                    // Reinicializar funcionalidad de ordenamiento
                    if (typeof window.initializeSorting === "function") {
                        window.initializeSorting();
                    }
                }, 10);
            }
        })
        .catch((err) => {
            // Error silencioso, no mostrar en producción
        });
}

function initBootstrapComponents() {
    // Inicializar todos los dropdowns después de cargar contenido dinámico

    // Verificar si Bootstrap está disponible
    if (typeof window.bootstrap === "undefined") {
        return;
    }

    const dropdownElementList = document.querySelectorAll(
        '[data-bs-toggle="dropdown"]'
    );

    if (dropdownElementList.length === 0) {
        return;
    }

    [...dropdownElementList].forEach((dropdownToggleEl, index) => {
        try {
            // Destruir instancia existente si existe
            const existingInstance =
                window.bootstrap.Dropdown.getInstance(dropdownToggleEl);
            if (existingInstance) {
                existingInstance.dispose();
            }

            // Crear nueva instancia
            const dropdown = new window.bootstrap.Dropdown(dropdownToggleEl);

            // Agregar evento de clic manualmente para forzar el toggle
            dropdownToggleEl.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropdown.toggle();
            });
        } catch (error) {
            // Error silencioso
        }
    });
}

function attachDynamicEventListeners() {
    // Event listener para el link de cantidades en la vista de UEB
    const linkUebCantidades = document.getElementById("link-ueb-cantidades");
    if (linkUebCantidades) {
        linkUebCantidades.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(linkUebCantidades.href);
        });
    }

    // Event listener para volver a la vista principal de UEB
    const linkBackUeb = document.getElementById("link-back-ueb");
    if (linkBackUeb) {
        linkBackUeb.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(linkBackUeb.href);
        });
    }

    // Event listeners para los enlaces del dropdown de Embalse
    const dropdownItems = document.querySelectorAll(
        ".dropdown-menu .dropdown-item"
    );
    dropdownItems.forEach((item) => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const href = item.getAttribute("href");
            if (href && href !== "#") {
                console.log("📋 Cargando vista desde dropdown:", href);
                cargarVista(href);
            }
        });
    });

    // Event listener para el link "Embalses" en el header de embalse
    const linkEmbalseHome = document.getElementById("link-embalse-home");
    if (linkEmbalseHome) {
        linkEmbalseHome.addEventListener("click", (e) => {
            e.preventDefault();
            cargarVista(linkEmbalseHome.href);
        });
    }
}

// Función para actualizar el elemento activo del sidebar según la ruta
function actualizarSidebarActivo(ruta) {
    // Remover clase 'active' de todos los enlaces del sidebar
    const todosLosLinks = document.querySelectorAll(".side-nav-link");
    todosLosLinks.forEach((link) => link.classList.remove("active"));

    // Determinar qué enlace debe estar activo según la ruta
    let linkActivo = null;

    if (ruta.startsWith("/ueb")) {
        linkActivo = "ueb";
    } else if (ruta.startsWith("/embalse")) {
        linkActivo = "embalse";
    } else if (ruta.startsWith("/especie")) {
        linkActivo = "especie";
    }

    // Agregar clase 'active' al enlace correspondiente (desktop y mobile)
    if (linkActivo) {
        const linkDesktop = document.getElementById(`link-${linkActivo}`);
        const linkMobile = document.getElementById(`mobile-link-${linkActivo}`);

        if (linkDesktop) {
            linkDesktop.classList.add("active");
        }

        if (linkMobile) {
            linkMobile.classList.add("active");
        }
    }
}
