import {AppError} from "../utils/AppError.js"
import { Organismo } from "../model/organismoModel.js";

export class OrganismoService{
    constructor(repository){
        this.repository = repository;
    }
    async getAll(){
        try{
            const organismos = await this.repository.findAll();
            return organismos;
        }catch(error){
            throw new AppError(
                "Error al obtener organismos",
                500
            )
        }
    }
    async findById(id){
        try{
            const organismo = await this.repository.findById(id);
            
            if(!organismo){
                throw new AppError(
                    "Organismo no existe",
                    404
                )
            }
            return organismo;
        }catch(error){
            if(error instanceof AppError){
                throw error
            }
            console.error("Error en OrganismoService.findById:", error);
            throw new AppError(
                "Error al obtener el organismo",
                500
            );
        }
    }

    async create(data){
        try{
            
            const organismo = new Organismo({nombre: data.nombre});
            return await this.repository.create(organismo);
            
        }catch(error){
            console.log("Error en OrganismoService.create", error)
            throw new AppError("Error creando organismo",500);
        }
    }
}