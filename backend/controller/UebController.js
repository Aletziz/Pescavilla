export class UebController {
  constructor(servicio) {
    this.servicio = servicio;
  }

  getAll = async (req, res, next) => {
    const data = await this.servicio.getAll();
    res.json(data);
  };
}
