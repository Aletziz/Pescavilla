import { z } from "zod";

// ID (params)
export const idUebSchema = z.object({
  id: z
    .string()
    .transform(Number)
    .refine((v) => Number.isInteger(v) && v > 0),
});

// CREATE
export const createUebSchema = z.object({
  nombre_ueb: z
    .string()
    .min(1)
    .transform((v) => v.toLowerCase()),
  id_organismo: z
    .number({
      required_error: "El id_organismo es obligatorio",
    })
    .int()
    .positive("El id_organismo debe ser un entero positivo"),
});

// UPDATE (PUT)
export const updateUebSchema = z.object({
  id: z
    .string()
    .transform((val) => Number(val))
    .refine((val) => Number.isInteger(val) && val > 0, {
      message: "ID inválido",
    }),

  nombre_ueb: z
    .string({
      required_error: "El nombre_ueb es obligatorio",
    })
    .min(1, "El nombre_ueb no puede estar vacío")
    .transform((val) => val.toLowerCase()),

  id_organismo: z
    .number({
      required_error: "El id_organismo es obligatorio",
    })
    .int()
    .positive("El id_organismo debe ser un entero positivo"),
});
