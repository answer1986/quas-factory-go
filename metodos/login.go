package metodos

import (
	"crypto/md5"
	"database/sql"
	"encoding/hex"
	"text/template"
	"log"
	"net/http"
	"quasfactory/conexion_rutas"
)

var plantillas=template.Must(template.ParseGlob("plantillas/*"))

type User struct{
	Id int
	Username string
	Pass string
}



func Login(w http.ResponseWriter, r *http.Request) {
	r.ParseForm()
	Username := r.Form.Get("usuario")
	p := r.Form.Get("password")

	conexion_rutas.ConexionBD()
	Password:=GetMD5Hash(p)
	db := conexion_rutas.ConexionBD()
	sqlStmt := "SELECT * FROM usuarios WHERE usuario = ? AND password = ?"

	var id int
	row := db.QueryRow(sqlStmt, Username, Password)

	switch err := row.Scan(&id); err {
		
	case sql.ErrNoRows:
			plantillas.ExecuteTemplate(w, "/login", nil)
			default:
			plantillas.ExecuteTemplate(w, "/Inicio", nil)
				log.Println("conexion exitosa");
				
			}

			
			defer db.Close()
}

func GetMD5Hash(text string) string {
	hasher := md5.New()
	hasher.Write([]byte(text))
	return hex.EncodeToString(hasher.Sum(nil))
}
