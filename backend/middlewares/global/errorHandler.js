import {ZodError} from "zod";
import { AppError } from "../../utils/AppError.js";


const errorHandler = (err, req, res, next) => {

  if (err instanceof ZodError) {
    return res.status(400).json({
      error: "Datos inválidos",
      details: err.issues.map(e => ({
        parametro: e.path.join("."),
        message: e.message,
      })),
    });
  }

  if (err instanceof AppError) {
    return res.status(err.statusCode).json({
      error: err.message,
      status: err.statusCode
    });
  }

  console.error(err);

  return res.status(500).json({
    error: "Error interno del servidor",
  });
};

export default errorHandler;