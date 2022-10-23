package main

import (
	"log"
	"quasfactory/conexion_rutas"
	
)





func main() {

	conexion_rutas.ConexionBD()
	conexion_rutas.Enrutador()
	log.Println("Servidor corriendo en http://localhost:9090")
	

	
}




