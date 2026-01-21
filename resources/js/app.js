import "./bootstrap";
import "./router";
import "./search";
import "./sort";

document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".side-nav-link");
    if (!links || links.length === 0) {
        // no hay enlaces, nada que hacer
        return;
    }

    links.forEach((link) => {
        link.addEventListener("click", () => {
            openCollaps(links);
            link.classList.add("active");
        });
    });
});

function openCollaps(links) {
    links.forEach((x) => {
        x.classList.remove("active"); // eliminar la clase active
        const targetID = x.getAttribute("aria-controls");
        if (targetID) {
            const menu = document.getElementById(targetID);
            if (!menu) return;
            // usar window.bootstrap (exportado en bootstrap.js)
            const bsCollapse = window.bootstrap?.Collapse.getInstance(menu);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    });
}
