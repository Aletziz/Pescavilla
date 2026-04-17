import {AppError} from "../utils/AppError.js"

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
            console.log(id)
            const organismo = await this.repository.findById(id);
            
            console.log(organismo);

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
}