import { OrganismoRepositoryPostgres } from "../repository/OrganismoPostgres.js";
import { OrganismoService } from "../service/organismo.service.js"; 
import { OrganismoController } from "../controller/OrganismoController.js";
import organismoRoutes from "../routes/organismo.routes.js";

export default function buildOrganismoModule() {
  // 1. repositorio (infraestructura)
  const repo = new OrganismoRepositoryPostgres();

  // 2. servicio (lógica)
  const service = new OrganismoService(repo);

  // 3. controller (adaptador HTTP)
  const controller = new OrganismoController(service);

  // 4. rutas (Express adapter)
  const router = organismoRoutes(controller);

  return router;
}