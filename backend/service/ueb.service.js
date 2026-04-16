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
}
