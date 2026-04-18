import { AppError, NotFoundError} from "../errors/index.js";
import {Ueb} from "../model/uebModel.js"


export class UebService {
  constructor(UebRepository, organismoService) {
    this.repository = UebRepository;
    this.organismoService = organismoService; 
  }

  async getAll() {
      const uebs = await this.repository.findAll();
      return uebs;
  }

  async getById(id) {
      const ueb = await this.repository.findById(id);
      if (!ueb) throw new NotFoundError("UEB no encontrada");
      return ueb;
  }

  async create(data) {
      const organismo = await this.organismoService.findById(data.id_organismo);

      if(!organismo) throw new NotFoundError("Organismo no encontrado");

      const ueb = new Ueb({nombre_ueb: data.nombre_ueb, id_organismo: data.id_organismo});

      return await this.repository.create(ueb); 
  }

  async update(id, data) {
      const ueb = await this.repository.findById(id);
      const organismo = await this.organismoService.findById(data.id_organismo);

      if(!ueb)throw new NotFoundError("Ueb no existe");
      if(!organismo)throw new NotFoundError("Organismo no existe");

      const UebActualizado = new Ueb({nombre_ueb: data.nombre_ueb, id_organismo: data.id_organismo});
      
      return await this.repository.update(id, UebActualizado);  
    
  }

  async delete(id) {
    const Ueb = await this.repository.findById(id);

    if(!Ueb) throw new NotFoundError("Ueb no existe");
    
    await this.repository.delete(id);

    return { mensaje: "Ueb eliminado correctamente", id };

  }
}
