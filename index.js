import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import notFound from "./backend/middlewares/global/notFound.js";
import errorHandler from "./backend/middlewares/global/errorHandler.js";

//ensambladores
import buildOrganismoModule from "./backend/bootstrap/organismo.module.js";
import buildUebModule from "./backend/bootstrap/ueb.module.js";

// router
const organismoRouter = buildOrganismoModule();
const uebRouter = buildUebModule();

// configuracion de express
const app = express();
app.use(cors());
app.use(express.json());

// rutas
app.get("/", (req, res) => {
  res.json({
    message: "API Pescavilla funcionando correctamente",
    status: "OK",
    timestamp: new Date().toISOString(),
  });
});

app.use("/organismo", organismoRouter);
app.use("/ueb", uebRouter);

// rutas no definidas
app.use(notFound);
app.use(errorHandler);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Servidor corriendo en puerto ${PORT}`, "http://localhost:3000");
});
