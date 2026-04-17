import pool from "./backend/config/database.js";

async function testConnection() {
  try {
    const result = await pool.query('SELECT * FROM public.UEB');
    console.log('✅ Conexión exitosa a PostgreSQL');
    console.log(result.rows)
    
  } catch (error) {
    console.error('❌ Error de conexión:', error.message);
  } finally {
    // Cerrar el pool después de la prueba
    await pool.end();
  }
}

//testConnection();

import { OrganismoRepositoryPostgres } from "./backend/repository/OrganismoPostgres.js";

const OrganismoPostgre = new OrganismoRepositoryPostgres();

const result = await OrganismoPostgre.findAll();

//console.log(result);

import { OrganismoService } from "./backend/service/organismo.service.js";
import { OrganismoController } from "./backend/controller/OrganismoController.js";



const OrgServive = new OrganismoService(OrganismoPostgre);

//console.log(await OrgServive.getAll());

const result2 = await pool.query(`
      SELECT id_organismo, nombre 
      FROM organismo 
      WHERE id_organismo = 9001
    `);
console.log(result2.rows);