import { ZodError } from "zod";
import { AppError, NotFoundError} from "../../errors/index.js";

const errorHandler = (err, req, res, next) => {

  if (err instanceof SyntaxError && err.status === 400 && "body" in err) {
    return res.status(400).json({
      error: "JSON inválido",
      message: err.message
    });
  }
  
  if (err instanceof NotFoundError) {
    return res.status(404).json({ error: err.message });
  }

  if (err instanceof AppError) {
    return res.status(err.statusCode || 400).json({ error: err.message });
  }

    console.log("Constructor:", err.constructor);
    console.log("Name:", err.constructor.name);
    console.error(err);

  return res.status(500).json({
    error: "Error interno del servidor",
  });
};

export default errorHandler;