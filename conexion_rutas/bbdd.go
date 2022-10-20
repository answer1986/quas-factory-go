package conexion_rutas

import (
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
)


func ConexionBD() (conexion *sql.DB) {
	Driver := "mysql"
	User := "test"
	Pass := "123456"
	Name := "quas-factory"
	

	conexion, err := sql.Open(Driver, User+":"+Pass+"@tcp(127.0.0.1:8889)/"+Name)
	if err != nil {
		panic(err.Error())
	}
	return conexion
}