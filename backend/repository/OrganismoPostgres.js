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

  async findById(id) {
    try {
          
      const query = `
        SELECT id_organismo, nombre 
        FROM organismo 
        WHERE id_organismo = ${id}`;
      const result = await pool.query(query);

      // Si no encontró nada
      if (result.rows.length === 0) {
        return null;
      }

      const row = result.rows[0];
      // Devuelve el registro como objeto
      return new Organismo({
        id_organismo: row.id_organismo,
        nombre: row.nombre
      });

    } catch (error) {
      console.error("Error en OrganismoRepository.findById:", error);
      throw new Error("Error al obtener organismo por id");
    }
  }

  async create(data){
    try{
      const safeName = data.nombre.replace(/'/g, "''");
      const query = `INSERT INTO organismo (nombre)
                      VALUES ('${safeName}')
                      RETURNING id_organismo, nombre`;
      const result = await pool.query(query);

      const row = result.rows[0];
      return new Organismo({
        id_organismo: row.id_organismo,
        nombre: row.nombre
      });

    }catch(err){
      console.error("Error en OrganismoRepository.create: ", err);
      throw new Error("Error al crear organismo nuevo");
    }
  }

  
}