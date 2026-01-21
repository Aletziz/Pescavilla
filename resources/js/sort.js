// Sistema de ordenamiento de tablas
let currentSort = {
    column: null,
    direction: "asc",
    table: null,
};

// Inicializar al cargar el DOM
document.addEventListener("DOMContentLoaded", function () {
    initializeSorting();
});

// Función para inicializar el ordenamiento
function initializeSorting() {
    // Buscar todos los botones de ordenar en dropdowns
    const sortOptions = document.querySelectorAll(".sort-option");

    if (sortOptions.length === 0) {
        return;
    }

    sortOptions.forEach((option) => {
        option.addEventListener("click", function (e) {
            e.preventDefault();

            const column = this.dataset.column;
            const dataType = this.dataset.type || "text";

            // Encontrar la tabla más cercana al dropdown
            const dropdown = this.closest(".dropdown");
            const card = dropdown.closest(".card");
            const table = card.querySelector("table.sortable-table");

            if (!table) {
                return;
            }

            const tableType = table.dataset.table;

            // Determinar dirección del ordenamiento
            if (currentSort.column === column && currentSort.table === table) {
                currentSort.direction =
                    currentSort.direction === "asc" ? "desc" : "asc";
            } else {
                currentSort.direction = "asc";
            }

            currentSort.column = column;
            currentSort.table = table;

            // Actualizar el texto del botón para mostrar qué se está ordenando
            updateSortButtonText(
                dropdown,
                this.textContent,
                currentSort.direction
            );

            // Ordenar la tabla
            sortTable(table, column, dataType, currentSort.direction);
        });
    });
}

function updateSortButtonText(dropdown, columnName, direction) {
    const button = dropdown.querySelector("button");
    if (button) {
        const icon = direction === "asc" ? "bi-sort-down" : "bi-sort-up";
        const arrow = direction === "asc" ? "↑" : "↓";
        button.innerHTML = `<i class="bi ${icon} me-1"></i><span>${columnName} ${arrow}</span>`;
    }
}

function sortTable(table, column, dataType, direction) {
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    // Filtrar filas que no son datos (mensajes de "no hay registros", etc.)
    const dataRows = rows.filter((row) => {
        const cells = row.cells;
        return (
            cells.length > 1 &&
            !row.classList.contains("no-results-message") &&
            !row.textContent.includes("No hay") &&
            !row.textContent.includes("No se encontraron")
        );
    });

    if (dataRows.length === 0) {
        return;
    }

    // Obtener el índice de la columna
    const headerCells = Array.from(table.querySelectorAll("thead th"));
    const columnIndex = headerCells.findIndex(
        (th) => th.dataset.column === column
    );

    if (columnIndex === -1) {
        return;
    }

    // Ordenar las filas
    dataRows.sort((a, b) => {
        let aValue = a.cells[columnIndex]?.textContent.trim() || "";
        let bValue = b.cells[columnIndex]?.textContent.trim() || "";

        // Limpiar valores para badges y formatos
        aValue = cleanValue(aValue);
        bValue = cleanValue(bValue);

        let comparison = 0;

        if (dataType === "number") {
            // Convertir a número, eliminar comas y puntos de miles
            const aNum = parseFloat(aValue.replace(/,/g, "")) || 0;
            const bNum = parseFloat(bValue.replace(/,/g, "")) || 0;
            comparison = aNum - bNum;
        } else {
            // Comparación de texto
            comparison = aValue.localeCompare(bValue, "es", {
                sensitivity: "base",
            });
        }

        return direction === "asc" ? comparison : -comparison;
    });

    // Reordenar el tbody
    dataRows.forEach((row) => tbody.appendChild(row));

    // Actualizar los números de fila (#)
    updateRowNumbers(tbody);
}

function cleanValue(value) {
    // Remover badges y contenido HTML
    value = value.replace(/\s+/g, " ").trim();

    // Si el valor es 'N/A', tratarlo como vacío para ordenamiento
    if (value === "N/A" || value === "N / A") {
        return "";
    }

    return value;
}

function updateRowNumbers(tbody) {
    const rows = tbody.querySelectorAll("tr");
    let counter = 1;

    rows.forEach((row) => {
        // Solo actualizar filas de datos, no mensajes
        if (
            row.cells.length > 1 &&
            !row.classList.contains("no-results-message") &&
            !row.textContent.includes("No hay") &&
            !row.textContent.includes("No se encontraron")
        ) {
            const firstCell = row.cells[0];
            if (firstCell) {
                firstCell.textContent = counter++;
            }
        }
    });
}

// Exportar para uso global
window.initializeSorting = initializeSorting;
