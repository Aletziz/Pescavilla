export class UebController {
  constructor(servicio) {
    this.servicio = servicio;
  }

  getAll = async (req, res, next) => {
    const data = await this.servicio.getAll();
    res.json(data);
  };

  getById = async (req, res, next) => {
    const { id } = req.params;
    const data = await this.servicio.getById(id);
    res.json(data);
  };

  create = async (req, res, next) => {
    const data = await this.servicio.create(req.body);
    res.status(201).json(data);
  };

  update = async (req, res, next) => {
    const { id } = req.params;
    const data = await this.servicio.update(id, req.body);
    res.json(data);
  };

  delete = async (req, res, next) => {
    const { id } = req.params;
    const data = await this.servicio.delete(id);
    res.json(data);
  };
}
