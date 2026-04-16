import express from "express";
import asyncHandler from "../utils/asyncHandler.js";

export default function uebRoutes(controller) {
  const router = express.Router();

  router.get("/", asyncHandler(controller.getAll));

  return router;
}
