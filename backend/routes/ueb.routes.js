import express from "express";
import asyncHandler from "../utils/asyncHandler.js";
import validate from "../middlewares/validate.js";
import {
  idUebSchema,
  createUebSchema,
  updateUebSchema,
} from "../validations/ueb.validation.js";

export default function uebRoutes(controller) {
  const router = express.Router();

  router.get("/", asyncHandler(controller.getAll));

  router.get(
    "/:id",
    validate(idUebSchema, "params"),
    asyncHandler(controller.getById),
  );

  router.post(
    "/",
    validate(createUebSchema, "body"),
    asyncHandler(controller.create),
  );

  router.put(
    "/:id",
    validate(idUebSchema, "params"),
    validate(updateUebSchema, "body"),
    asyncHandler(controller.update),
  );

  router.delete(
    "/:id",
    validate(idUebSchema, "params"),
    asyncHandler(controller.delete),
  );

  return router;
}
