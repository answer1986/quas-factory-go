package main

import ("log"
		"conexion_rutas/bbdd"
)





func main() {
	Enrutador()
	ConexionBD()
	log.Println("Servidor corriendo en http://localhost:9090")

	
}




