package routes

import (
	"todo-api/controllers"
	"net/http"

	"github.com/gorilla/mux"
)

func RegisterRoutes() *mux.Router {
	router := mux.NewRouter()

	// ROUTE akuh
	router.HandleFunc("/tasks", controllers.GetTasks).Methods("GET") // GET
	router.HandleFunc("/tasks", controllers.CreateTask).Methods("POST") // POST
	router.HandleFunc("/tasks/{id}", controllers.UpdateTask).Methods("PUT") // PUT
	router.HandleFunc("/tasks/{id}/done", controllers.MarkTaskDone).Methods("PATCH") // PATCH
	router.HandleFunc("/tasks/{id}", controllers.DeleteTask).Methods("DELETE") // DELETE




	// tes root
	router.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		w.Write([]byte("Todo API is running!"))
	})

	return router
}
