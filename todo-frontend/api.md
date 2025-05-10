# Get All Task

http://localhost:8080/tasks

output:

```json
[
    {
        "id": 2,
        "title": "Belajar Golang",
        "description": "Sesi PATCH API",
        "is_completed": true,
        "created_at": "2025-05-10T09:27:14.293546+07:00",
        "updated_at": "2025-05-10T09:27:23.807166+07:00"
    },
    {
        "id": 1,
        "title": "Belajar Golang (Edit)",
        "description": "Sudah bisa edit API!",
        "is_completed": true,
        "created_at": "2025-05-10T09:16:56.094023+07:00",
        "updated_at": "2025-05-10T09:26:14.95685+07:00"
    }
]
```

# POST Create Task

http://localhost:8080/tasks

body:

```json
{
    "title": "Belajar Golang",
    "description": "Sesi DELETE API",
    "is_completed": false
}
```
output:

```json
{
    "id": 6,
    "title": "Belajar Golang",
    "description": "Sesi DELETE API",
    "is_completed": false,
    "created_at": "2025-05-10T09:31:54.6954442+07:00",
    "updated_at": "2025-05-10T09:31:54.6954442+07:00"
}
```

# PUT Edit Task

http://localhost:8080/tasks/1

body:

```json
{
    "title": "Belajar Golang (Edit)",
    "description": "Sudah bisa edit API!",
    "is_completed": true
}
```

output:

```json
{
    "id": 1,
    "title": "Belajar Golang (Edit)",
    "description": "Sudah bisa edit API!",
    "is_completed": true,
    "created_at": "2025-05-10T09:16:56.094023+07:00",
    "updated_at": "2025-05-10T09:22:55.1897227+07:00"
}
```

# PATCH Complete Task

http://localhost:8080/tasks/1/done

output:

```json
{
    "id": 2,
    "title": "Belajar Golang",
    "description": "Sesi PATCH API",
    "is_completed": true,
    "created_at": "2025-05-10T09:27:14.293546+07:00",
    "updated_at": "2025-05-10T09:27:23.8071667+07:00"
}
```

# DELETE Delete Task

http://localhost:8080/tasks/1

output: 204


