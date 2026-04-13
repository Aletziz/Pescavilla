const errorHandler = (err, req, res, next) => {
  console.error("❌ ERROR:", err);

  const statusCode = err.statusCode || 500;

  res.status(statusCode).json({
    status: "ERROR",
    message: err.message || "Error interno del servidor",
    path: req.path,
    method: req.method,
  });
};

export default errorHandler;