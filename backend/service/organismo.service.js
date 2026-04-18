import {AppError, NotFoundError } from "../errors/index.js"
import { Organismo } from "../model/organismoModel.js";

export class OrganismoService{
    constructor(repository){
        this.repository = repository;
    }
    async getAll(){
        
        const organismos = await this.repository.findAll();
        return organismos;
        
    }
    async findById(id){
        
        const organismo = await this.repository.findById(id);
        
        if(!organismo) throw new NotFoundError("Organismo no encontrado");
        
        return organismo;
        
    }

    async create(data){
        const organismo = new Organismo({nombre: data.nombre});
        return await this.repository.create(organismo);    
    }

    async getUebsByOrganismo(idOrganismo) {
        const organismo = await this.repository.findById(idOrganismo);

        if (!organismo) {
            throw new NotFoundError("Organismo no existe");
        }

        return await this.repository.getUebsByOrganismo(idOrganismo);
    }



    async update(id, data){
        const organismo = await this.repository.findById(id);
        
        if(!organismo) throw new NotFoundError("Organismo no existe");
       
        const organismoActualizado = new Organismo({nombre: data.nombre});

        return await this.repository.update(id, organismoActualizado);    
    }

    async delete(id){
        const organismo = await this.repository.findById(id);
            
        if(!organismo) throw new NotFoundError("Organismo no existe");
        
        await this.repository.delete(id);
        
        return { mensaje: "Organismo eliminado correctamente", id };   
    }
}