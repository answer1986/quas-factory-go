package conexion_rutas

import (
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
	"log"
)


func ConexionBD() (conexion *sql.DB) {
	Driver := "mysql"
	User := "test"
	Pass := "123456"
	Name := "quas-factory"
	
	log.Println("Servidor corriendo en http://localhost:9090")
	conexion, err := sql.Open(Driver, User+":"+Pass+"@tcp(127.0.0.1:8889)/"+Name)
	if err != nil {
		panic(err.Error())
	
	}
	return conexion
	
}