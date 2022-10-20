package main

import (
	"log"
	"quasfactory/conexion_rutas"
	"quasfactory/metodos"
)





func main() {

	conexion_rutas.ConexionBD()
	metodos.Login()
	
	
	conexion_rutas.Enrutador()
	log.Println("Servidor corriendo en http://localhost:9090")

	
}




