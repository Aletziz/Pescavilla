// Funcionalidad de búsqueda en tablas
document.addEventListener("DOMContentLoaded", function () {
    initializeSearch();
});

// También inicializar después de cargar contenido AJAX
function initializeSearch() {
    // Buscador de UEB
    const searchUeb = document.getElementById("search-ueb");
    if (searchUeb) {
        searchUeb.addEventListener("input", function (e) {
            filterTable(e.target.value, "ueb");
        });
    }

    // Buscador de Embalse
    const searchEmbalse = document.getElementById("search-embalse");
    if (searchEmbalse) {
        searchEmbalse.addEventListener("input", function (e) {
            filterTable(e.target.value, "embalse");
        });
    }

    // Buscador de Especie
    const searchEspecie = document.getElementById("search-especie");
    if (searchEspecie) {
        searchEspecie.addEventListener("input", function (e) {
            filterTable(e.target.value, "especie");
        });
    }
}

function filterTable(searchText, tableType) {
    const searchValue = searchText.toLowerCase().trim();

    // Buscar todas las tablas en la página
    const tables = document.querySelectorAll("table tbody");

    tables.forEach((tbody) => {
        const rows = tbody.querySelectorAll("tr");
        let visibleCount = 0;

        rows.forEach((row) => {
            // Ignorar filas de "No hay registros"
            if (row.cells.length === 1 && row.textContent.includes("No hay")) {
                return;
            }

            const text = row.textContent.toLowerCase();

            if (searchValue === "" || text.includes(searchValue)) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Mostrar mensaje si no hay resultados
        showNoResultsMessage(tbody, visibleCount, searchValue);
    });
}

function showNoResultsMessage(tbody, visibleCount, searchValue) {
    // Remover mensaje previo si existe
    const existingMessage = tbody.querySelector(".no-results-message");
    if (existingMessage) {
        existingMessage.remove();
    }

    // Si no hay filas visibles y hay texto de búsqueda, mostrar mensaje
    if (visibleCount === 0 && searchValue !== "") {
        const colCount =
            tbody.parentElement.querySelector("thead tr")?.cells.length || 3;
        const messageRow = document.createElement("tr");
        messageRow.className = "no-results-message";
        messageRow.innerHTML = `
            <td colspan="${colCount}" class="text-center text-muted py-4">
                <i class="bi bi-search me-2"></i>
                No se encontraron resultados para "<strong>${searchValue}</strong>"
            </td>
        `;
        tbody.appendChild(messageRow);
    }
}

// Exportar para que esté disponible en el router
window.initializeSearch = initializeSearch;
