package main

import (
	"fmt"
	"log"
	"net/http"
	"todo-api/config"
	"todo-api/models"
	"todo-api/routes"
)

func main() {
	config.ConnectDB()
	models.AutoMigrate()

	router := routes.RegisterRoutes()

	fmt.Println("Server running on http://localhost:8080")
	log.Fatal(http.ListenAndServe(":8080", router))
}
