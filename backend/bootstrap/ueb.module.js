import { UebRepositoryPostgres } from "../repository/UebPostgres.js";
import { OrganismoRepositoryPostgres } from "../repository/OrganismoPostgres.js"

import { UebService } from "../service/ueb.service.js";
import { OrganismoService } from "../service/organismo.service.js";

import { UebController } from "../controller/UebController.js";

import uebRoutes from "../routes/ueb.routes.js";

export default function buildUebModule() {
  // 1. repositorio (infraestructura)
  const repo = new UebRepositoryPostgres();
  const repoOrganismo = new OrganismoRepositoryPostgres();

  // 2. servicio (lógica)
  const serviceOrganismo = new OrganismoService(repoOrganismo);
  const service = new UebService(repo, serviceOrganismo);

  // 3. controller (adaptador HTTP)
  const controller = new UebController(service);

  // 4. rutas (Express adapter)
  const router = uebRoutes(controller);

  return router;
}
