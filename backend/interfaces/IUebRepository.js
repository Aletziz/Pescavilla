/**
 * @interface
 * Contrato que debe cumplir cualquier implementación del repositorio de UEB.
 */
export class IUebRepository {
  /**
   * Retorna todas las UEBs.
   * @returns {Promise<import("../model/uebModel.js").Ueb[]>}
   */
  async findAll() {
    throw new Error("Metodo no implementado: findAll");
  }

  /**
   * Retorna una UEB por su id_ueb.
   * @param {number} id
   * @returns {Promise<import("../model/uebModel.js").Ueb|null>}
   */
  async findById(id) {
    throw new Error("Metodo no implementado: findById");
  }

  /**
   * Crea una nueva UEB.
   * @param {{ nombre_ueb: string, id_organismo: number }} data
   * @returns {Promise<import("../model/uebModel.js").Ueb>}
   */
  async create(data) {
    throw new Error("Metodo no implementado: create");
  }

  /**
   * Actualiza una UEB existente.
   * @param {number} id
   * @param {{ nombre_ueb: string, id_organismo: number }} data
   * @returns {Promise<import("../model/uebModel.js").Ueb|null>}
   */
  async update(id, data) {
    throw new Error("Metodo no implementado: update");
  }

  /**
   * Elimina una UEB por su id_ueb.
   * @param {number} id
   * @returns {Promise<boolean>}
   */
  async delete(id) {
    throw new Error("Metodo no implementado: delete");
  }
}
