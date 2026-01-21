import axios from "axios";
// Bootstrap JS (importar y exponer como window.bootstrap para usar Collapse u otros componentes)
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
