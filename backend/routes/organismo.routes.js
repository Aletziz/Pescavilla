import express from "express";
import asyncHandler from "../utils/asyncHandler.js";
import validate from "../middlewares/global/validate.js";

//validaciones
import { idSchema } from "../validations/organismo.validation.js";
import { createOrganismoSchema, updateBodyOrganismoSchema } from "../validations/organismo.validation.js"; 

export default function organismoRoutes(controller) {
  const router = express.Router();

  router.get("/", asyncHandler(controller.getAll));
  router.get("/:id", validate(idSchema, "params") ,asyncHandler(controller.findById));
  router.get("/:id/uebs", validate(idSchema, "params"), asyncHandler(controller.getUebs));
  
  router.post("/", validate(createOrganismoSchema), asyncHandler(controller.create));
  
  router.put("/:id", validate(idSchema, "params"), validate(updateBodyOrganismoSchema), asyncHandler(controller.update));
  
  router.delete("/:id", validate(idSchema, "params"), asyncHandler(controller.delete));

  return router;
}