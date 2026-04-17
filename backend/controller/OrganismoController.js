export class OrganismoController{

    constructor(servicio){
        this.servicio = servicio;
    }

    getAll = async (req, res, next) => {
        const data = await this.servicio.getAll();
        res.json(data);
    };

    findById = async (req, res, next) => {
        const {id} = req.params;
        const data = await this.servicio.findById(id);
        res.json(data);
    }
    create = async(req, res, next) =>{
        const result = await this.servicio.create(req.body);
        res.json(result);
    }
}