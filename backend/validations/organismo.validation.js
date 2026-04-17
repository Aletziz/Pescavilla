import { z } from "zod";


// ID (params)
export const idSchema = z.object({
  id: z.string().refine((val) => {
    const num = Number(val);
    return Number.isInteger(num) && num > 0;
  }, {
    message: "El id debe ser un número entero positivo"
  }).transform(Number),
});

// CREATE
export const createOrganismoSchema = z.object({
  nombre: z.string().min(1).transform(v => v.toLowerCase()),
});


// para PUT UPDATE
export const updateOrganismoSchema = z.object({
    id: z
    .string()
    .transform((val) => Number(val))
    .refine((val) => Number.isInteger(val) && val > 0, {
      message: "ID inválido",
    }),
    
    nombre: z.string({
      required_error: "El nombre es obligatorio",
    }).min(1, "El nombre no puede estar vacío").transform((val) => val.toLowerCase())
});