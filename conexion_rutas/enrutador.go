package conexion_rutas

import (
	"net/http"
	"text/template"
)

var plantillas = template.Must(template.ParseGlob("plantillas/*"))

func Enrutador() {
	http.HandleFunc("/", Inicio)
	http.HandleFunc("/login", Login)
	http.HandleFunc("/usuarios", Usuarios)
	http.HandleFunc("/bodega", Bodega)
	http.HandleFunc("/clientes", Clientes)
	http.HandleFunc("/ordendetrabajo", Ordendetrabajo)
	http.HandleFunc("/loginOk", LoginOk)
	http.Handle("/assets/", http.StripPrefix("/assets/", http.FileServer(http.Dir("assets/"))))
	http.ListenAndServe(":9090", nil)
	http.HandleFunc("/romana", Romana)

}

func Inicio(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "inicio", nil)
}

func Login(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "login", nil)
}

func Usuarios(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "usuarios", nil)
}

func Bodega(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "bodega", nil)
}

func Clientes(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "clientes", nil)
}

func Ordendetrabajo(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "orden de trabajo", nil)
}

func LoginOk(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "loginOk", nil)
}

func Romana(w http.ResponseWriter, r *http.Request) {
	plantillas.ExecuteTemplate(w, "romana", nil)
}
