import { AppError } from "../utils/AppError.js";

export class UebService {
  constructor(repository) {
    this.repository = repository;
  }

  async getAll() {
    try {
      const uebs = await this.repository.findAll();
      return uebs;
    } catch (error) {
      throw new AppError("Error al obtener UEBs", 500);
    }
  }

  async getById(id) {
    try {
      const ueb = await this.repository.findById(id);
      if (!ueb) throw new AppError("UEB no encontrada", 404);
      return ueb;
    } catch (error) {
      if (error instanceof AppError) throw error;
      throw new AppError("Error al obtener UEB", 500);
    }
  }

  async create(data) {
    try {
      const ueb = await this.repository.create(data);
      return ueb;
    } catch (error) {
      if (error instanceof AppError) throw error;
      throw new AppError("Error al crear UEB", 500);
    }
  }

  async update(id, data) {
    try {
      const ueb = await this.repository.update(id, data);
      if (!ueb) throw new AppError("UEB no encontrada", 404);
      return ueb;
    } catch (error) {
      if (error instanceof AppError) throw error;
      throw new AppError("Error al actualizar UEB", 500);
    }
  }

  async delete(id) {
    try {
      const deleted = await this.repository.delete(id);
      if (!deleted) throw new AppError("UEB no encontrada", 404);
      return { message: "UEB eliminada correctamente" };
    } catch (error) {
      if (error instanceof AppError) throw error;
      throw new AppError("Error al eliminar UEB", 500);
    }
  }
}
