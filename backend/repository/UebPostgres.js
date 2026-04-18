import { Ueb } from "../model/uebModel.js";
import { IUebRepository } from "../interfaces/IUebRepository.js";
import pool from "../config/database.js";

export class UebRepositoryPostgres extends IUebRepository {
  /**
   * @override
   */
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

  /**
   * @override
   * @param {number} id
   */
  async findById(id) {
    try {
      const query =
        "SELECT id_ueb, nombre_ueb, id_organismo FROM ueb WHERE id_ueb = $1";
      const result = await pool.query(query, [id]);

      if (result.rows.length === 0) return null;

      return new Ueb({
        id_ueb: result.rows[0].id_ueb,
        nombre_ueb: result.rows[0].nombre_ueb,
        id_organismo: result.rows[0].id_organismo,
      });
    } catch (error) {
      console.error("Error en UebRepository.findById:", error);
      throw new Error("Error al obtener UEB");
    }
  }

  /**
   * @override
   * @param {{ nombre_ueb: string, id_organismo: number }} data
   */
  async create(data) {
    try {
      const query =
        "INSERT INTO ueb (nombre_ueb, id_organismo) VALUES ($1, $2) RETURNING id_ueb, nombre_ueb, id_organismo";
      const result = await pool.query(query, [
        data.nombre_ueb,
        data.id_organismo,
      ]);
      
      return new Ueb({
        id_ueb: result.rows[0].id_ueb,
        nombre_ueb: result.rows[0].nombre_ueb,
        id_organismo: result.rows[0].id_organismo,
      });
    } catch (error) {
      console.error("Error en UebRepository.create:", error);
      
      throw new Error("Error al crear UEB");
    }
  }

  /**
   * @override
   * @param {number} id
   * @param {{ nombre_ueb: string, id_organismo: number }} data
   */
  async update(id, data) {
    try {
      const query =
        "UPDATE ueb SET nombre_ueb = $1, id_organismo = $2 WHERE id_ueb = $3 RETURNING id_ueb, nombre_ueb, id_organismo";
      const result = await pool.query(query, [
        data.nombre_ueb,
        data.id_organismo,
        id,
      ]);

      if (result.rows.length === 0) return null;

      return new Ueb({
        id_ueb: result.rows[0].id_ueb,
        nombre_ueb: result.rows[0].nombre_ueb,
        id_organismo: result.rows[0].id_organismo,
      });
    } catch (error) {
      console.error("Error en UebRepository.update:", error);
      throw new Error("Error al actualizar UEB");
    }
  }

  /**
   * @override
   * @param {number} id
   */
  async delete(id) {
    try {
      const query = "DELETE FROM ueb WHERE id_ueb = $1 RETURNING id_ueb";
      const result = await pool.query(query, [id]);

      return result.rows[0];
    } catch (error) {
      console.error("Error en UebRepository.delete:", error);
      throw new Error("Error al eliminar UEB");
    }
  }
}
