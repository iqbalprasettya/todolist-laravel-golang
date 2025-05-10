package controllers

import (
	"encoding/json"
	"net/http"
	"todo-api/config"
	"todo-api/models"

	"github.com/gorilla/mux"
)

func GetTasks(w http.ResponseWriter, r *http.Request) {
	var incompleteTasks []models.Task
	var completedTasks []models.Task

	// terlama ke terbaru
	if err := config.DB.Where("is_completed = ?", false).Order("created_at asc").Find(&incompleteTasks).Error; err != nil {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal mengambil data task yang belum selesai: " + err.Error(),
		})
		return
	}

	// terbaru ke terlama
	if err := config.DB.Where("is_completed = ?", true).Order("created_at desc").Find(&completedTasks).Error; err != nil {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal mengambil data task yang sudah selesai: " + err.Error(),
		})
		return
	}

	// gabung
	response := struct {
		IncompleteTasks []models.Task `json:"incomplete_tasks"`
		CompletedTasks  []models.Task `json:"completed_tasks"`
		TotalIncomplete int           `json:"total_incomplete"`
		TotalComplete   int           `json:"total_complete"`
	}{
		IncompleteTasks: incompleteTasks,
		CompletedTasks:  completedTasks,
		TotalIncomplete: len(incompleteTasks),
		TotalComplete:   len(completedTasks),
	}

	w.Header().Set("Content-Type", "application/json")
	if err := json.NewEncoder(w).Encode(response); err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal mengubah data ke format JSON: " + err.Error(),
		})
		return
	}
}

func CreateTask(w http.ResponseWriter, r *http.Request) {
	var task models.Task

	w.Header().Set("Content-Type", "application/json")

	if r.Body == nil {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Body request tidak boleh kosong",
		})
		return
	}

	err := json.NewDecoder(r.Body).Decode(&task)
	if err != nil {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Format JSON tidak valid: " + err.Error(),
		})
		return
	}

	// Validasi data
	if task.Title == "" {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Judul task tidak boleh kosong",
		})
		return
	}

	result := config.DB.Create(&task)
	if result.Error != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal membuat task: " + result.Error.Error(),
		})
		return
	}

	w.WriteHeader(http.StatusCreated)
	json.NewEncoder(w).Encode(task)
}

func UpdateTask(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")

	vars := mux.Vars(r)
	id := vars["id"]
	if id == "" {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "ID task tidak boleh kosong",
		})
		return
	}

	var task models.Task
	if err := config.DB.First(&task, id).Error; err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Task dengan ID " + id + " tidak ditemukan",
		})
		return
	}

	if r.Body == nil {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Body request tidak boleh kosong",
		})
		return
	}

	var updatedData models.Task
	if err := json.NewDecoder(r.Body).Decode(&updatedData); err != nil {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Format JSON tidak valid: " + err.Error(),
		})
		return
	}

	// Validasi data
	if updatedData.Title == "" {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Judul task tidak boleh kosong",
		})
		return
	}

	task.Title = updatedData.Title
	task.Description = updatedData.Description
	task.IsCompleted = updatedData.IsCompleted

	if err := config.DB.Save(&task).Error; err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal mengupdate task: " + err.Error(),
		})
		return
	}

	json.NewEncoder(w).Encode(task)
}

func MarkTaskDone(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	
	vars := mux.Vars(r)
	id := vars["id"]

	var task models.Task
	if err := config.DB.First(&task, id).Error; err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Task dengan ID " + id + " tidak ditemukan",
		})
		return
	}

	task.IsCompleted = true
	if err := config.DB.Save(&task).Error; err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal mengupdate status task: " + err.Error(),
		})
		return
	}

	json.NewEncoder(w).Encode(task)
}

func DeleteTask(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")

	vars := mux.Vars(r)
	id := vars["id"]
	if id == "" {
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "ID task tidak boleh kosong",
		})
		return
	}

	var task models.Task
	if err := config.DB.First(&task, id).Error; err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Task dengan ID " + id + " tidak ditemukan",
		})
		return
	}

	if err := config.DB.Delete(&task).Error; err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal menghapus task: " + err.Error(),
		})
		return
	}

	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(map[string]string{
		"message": "Task berhasil dihapus",
	})
}
