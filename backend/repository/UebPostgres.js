import { Ueb } from "../model/uebModel.js";
import { UebRepository } from "../interfaces/IUebRepository.js";
import pool from "../config/database.js";

export class UebRepositoryPostgres extends UebRepository {
  async findAll() {
    try {
      const query = "SELECT id_ueb, nombre_ueb, id_organismo FROM ueb";
      const result = await pool.query(query);

      return result.rows.map(
        (row) =>
          new Ueb({
            id_ueb: row.id_ueb,
            nombre_ueb: row.nombre_ueb,
            id_organismo: row.id_organismo,
          }),
      );
    } catch (error) {
      console.error("Error en UebRepository.findAll:", error);
      throw new Error("Error al obtener UEBs");
    }
  }
}
