import { UebRepositoryPostgres } from "../repository/UebPostgres.js";
import { UebService } from "../service/ueb.service.js";
import { UebController } from "../controller/UebController.js";
import uebRoutes from "../routes/ueb.routes.js";

export default function buildUebModule() {
  // 1. repositorio (infraestructura)
  const repo = new UebRepositoryPostgres();

  // 2. servicio (lógica)
  const service = new UebService(repo);

  // 3. controller (adaptador HTTP)
  const controller = new UebController(service);

  // 4. rutas (Express adapter)
  const router = uebRoutes(controller);

  return router;
}
