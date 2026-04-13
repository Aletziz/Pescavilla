import pool from "./backend/config/database.js";

async function testConnection() {
  try {
    const result = await pool.query('SELECT * FROM public.ORGANISMO');
    console.log('✅ Conexión exitosa a PostgreSQL');
    console.log(result.rows)
    
  } catch (error) {
    console.error('❌ Error de conexión:', error.message);
  } finally {
    // Cerrar el pool después de la prueba
    await pool.end();
  }
}

testConnection();