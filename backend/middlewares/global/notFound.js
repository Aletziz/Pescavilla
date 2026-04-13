import errorHandler from "./errorHandler.js";

const notFound =  (req, res, next) => {
  const error = new Error("Ruta no encontrada");

  error.statusCode = 404;
  error.path = req.path;
  error.method = req.method;

  next(error);
};

export default notFound;