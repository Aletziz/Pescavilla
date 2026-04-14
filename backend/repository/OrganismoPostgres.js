import { Organismo } from "../model/organismoModel.js";
import { OrganismoRepository } from "../interfaces/IOrganismoRepository.js";
import pool from "../config/database.js";

export class OrganismoRepositoryPostgres extends OrganismoRepository {
  async findAll() {
    try {
      const query = "SELECT id_organismo, nombre FROM organismo";
      const result = await pool.query(query);

      return result.rows.map(row => new Organismo({
            id_organismo: row.id_organismo,
            nombre: row.nombre
            }));

    } catch (error) {
      console.error("Error en OrganismoRepository.findAll:", error);

      throw new Error("Error al obtener organismos");
    }
  }
}