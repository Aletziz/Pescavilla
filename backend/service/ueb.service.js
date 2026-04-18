import { AppError } from "../errors/index.js";

export class UebService {
  constructor(repository) {
    this.repository = repository;
  }

  async getAll() {
    
      const uebs = await this.repository.findAll();
      return uebs;
  }
}
