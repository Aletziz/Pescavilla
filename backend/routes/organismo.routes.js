import express from "express";
import asyncHandler from "../utils/asyncHandler.js";
import validate from "../middlewares/global/validate.js";

//validaciones
import { idSchema } from "../validations/organismo.validation.js"; 

export default function organismoRoutes(controller) {
  const router = express.Router();

  router.get("/", asyncHandler(controller.getAll));
  router.get("/:id", validate(idSchema, "params") ,asyncHandler(controller.findById))

  return router;
}