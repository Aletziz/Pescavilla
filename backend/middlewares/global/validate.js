const validate = (schema, property = "body") => (req, res, next) => {
  try {
    // valida y reemplaza el body con datos limpios
    req[property] = schema.parse(req[property]);

    next(); // sigue al controller
  } catch (err) {
    next(err); // manda al errorHandler global
  }
};

export default validate;