import { AppError } from "../utils/AppError.js";

/**
 * Middleware reutilizable de validación con Zod.
 * @param {import("zod").ZodSchema} schema - Schema de Zod a validar
 * @param {"body"|"params"|"query"} source - De dónde viene el dato
 */
const validate = (schema, source = "body") => {
  return (req, res, next) => {
    const result = schema.safeParse(req[source]);

    if (!result.success) {
      const message = result.error.errors
        .map((e) => `${e.path.join(".")}: ${e.message}`)
        .join(", ");
      return next(new AppError(message, 400));
    }

    req[source] = result.data;
    next();
  };
};

export default validate;
