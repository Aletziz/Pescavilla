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
}