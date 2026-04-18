import { AppError } from "../errors/index.js";

/**
 * Middleware reutilizable de validación con Zod.
 * @param {import("zod").ZodSchema} schema - Schema de Zod a validar
 * @param {"body"|"params"|"query"} source - De dónde viene el dato
 */

const validate = (schema, source = "body") => {
  return (req, res, next) => {
    const result = schema.safeParse(req[source]);

    if (!result.success) {
      const message = result.error.issues
        .map((e) => `${e.path.join(".")}: ${e.message}`)
        .join(", ");
      return next(new AppError(message));
    }

    req[source] = result.data;
    next();
  };
};

export default validate;
