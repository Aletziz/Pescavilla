const validate = (schema) => (req, res, next) => {
  try {
    // valida y reemplaza el body con datos limpios
    req.body = schema.parse(req.body);

    next(); // sigue al controller
  } catch (err) {
    next(err); // manda al errorHandler global
  }
};

export default validate;