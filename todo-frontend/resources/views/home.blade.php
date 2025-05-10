<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="http://localhost:8000/build/assets/app-B6x-jV8x.js"></script>
    <link rel="stylesheet" href="http://localhost:8000/build/assets/app-DxfT2TXA.css">

    {{-- poppins font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-3 py-4 sm:px-6 sm:py-8">
    <div class="w-full max-w-xl p-4 sm:p-8">
        <h1 class="text-2xl sm:text-4xl font-400 mb-4 sm:mb-6 text-center">Task Management</h1>

        {{-- Form tambah/edit task --}}
        <form id="addTaskForm" method="POST" action="/tasks" class="mb-6 flex flex-col items-center w-full">
            @csrf
            <input type="hidden" id="taskId" name="taskId">
            <input type="hidden" id="method" name="_method" value="POST">
            <label for="title" class="text-sm mb-1.5 self-start text-gray-600">Title</label>
            <input type="text" id="title" name="title"
                class="border border-gray-300 rounded-lg px-3 py-2 w-full mb-3 focus:outline-none focus:ring-2 focus:ring-blue-200 text-sm sm:text-base"
                required />
            <div class="flex gap-2 w-full sm:w-auto">
                <button type="submit" id="submitBtn"
                    class="flex-1 sm:flex-none bg-[#6FCBFF] text-black px-5 py-2 rounded-xl hover:bg-[#5BB8E8] transition text-sm sm:text-base font-medium">Add
                    Task</button>
                <button type="button" id="cancelBtn" onclick="cancelEdit()"
                    class="flex-1 sm:flex-none bg-[#FF6F6F] text-black px-5 py-2 rounded-xl hover:bg-[#FF5252] transition hidden text-sm sm:text-base font-medium">Cancel</button>
            </div>
        </form>

        {{-- Ongoing Task --}}
        <div class="mb-5">
            <h2 class="text-base sm:text-lg font-semibold mb-3 text-gray-800">Ongoing Task</h2>
            <ul class="space-y-2.5">
                @foreach ($active as $task)
                    <li class="bg-gray-100 p-3 sm:p-4 rounded-xl flex flex-col shadow-sm">
                        <div class="flex justify-between items-center gap-3">
                            <div class="flex items-center space-x-2 min-w-0 flex-1">
                                <span
                                    class="font-400 text-sm sm:text-base break-words text-gray-800 line-clamp-2">{{ $task['title'] }}</span>
                                <button type="button" onclick='editTask({{ json_encode($task) }})' title="Edit"
                                    class="text-gray-500 hover:text-blue-500 ml-1 shrink-0">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5 sm:h-4 sm:w-4"></i>
                                </button>
                            </div>
                            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                                <button type="button" onclick="deleteTask({{ $task['id'] }})" title="Delete"
                                    class="text-gray-500 hover:text-black p-1">
                                    <i data-lucide="x-circle" class="h-5 w-5 sm:h-5 sm:w-5"></i>
                                </button>
                                <button type="button" onclick="completeTask({{ $task['id'] }})" title="Complete"
                                    class="text-gray-600 hover:text-green-500">
                                    <i data-lucide="circle" class="h-4 w-4 sm:h-5 sm:w-5"
                                        style="background: white; border-radius: 9999px;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-[11px] sm:text-xs text-gray-500 mt-1.5">
                            {{ \Carbon\Carbon::parse($task['created_at'])->format('d M Y H:i') }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Completed Task --}}
        <div>
            <h2 class="text-base sm:text-lg font-semibold mb-3 text-gray-800">Completed Task</h2>
            <ul class="space-y-2.5">
                @foreach ($done as $task)
                    <li class="bg-gray-100 p-3 sm:p-4 rounded-xl flex flex-col shadow-sm">
                        <div class="flex justify-between items-center gap-3">
                            <div class="flex items-center space-x-2 min-w-0 flex-1">
                                <span
                                    class="font-400 text-sm sm:text-base break-words text-gray-600 line-clamp-2 line-through">{{ $task['title'] }}</span>
                                <button type="button" onclick='editTask({{ json_encode($task) }})' title="Edit"
                                    class="text-gray-500 hover:text-blue-500 ml-1 shrink-0">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5 sm:h-4 sm:w-4"></i>
                                </button>
                            </div>
                            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                                <button type="button" onclick="deleteTask({{ $task['id'] }})" title="Delete"
                                    class="text-gray-500 hover:text-black p-1">
                                    <i data-lucide="x-circle" class="h-5 w-5 sm:h-5 sm:w-5"></i>
                                </button>
                                <button title="Complete" class="text-gray-600 hover:text-green-500">
                                    <i data-lucide="circle-check" class="h-4 w-4 sm:h-5 sm:w-5"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-[11px] sm:text-xs text-gray-500 mt-1.5">
                            {{ \Carbon\Carbon::parse($task['created_at'])->format('d M Y H:i') }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        function editTask(task) {
            document.getElementById('taskId').value = task.id;
            document.getElementById('title').value = task.title;
            document.getElementById('method').value = 'PUT';
            document.getElementById('submitBtn').textContent = 'Update Task';
            document.getElementById('submitBtn').classList.remove('bg-[#6FCBFF]', 'hover:bg-[#5BB8E8]');
            document.getElementById('submitBtn').classList.add('bg-[#FFB46F]', 'hover:bg-[#F5A86A]');
            document.getElementById('cancelBtn').classList.remove('hidden');
            document.getElementById('addTaskForm').action = `/tasks/${task.id}`;

            // Scroll
            document.getElementById('addTaskForm').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function cancelEdit() {
            document.getElementById('addTaskForm').reset();
            document.getElementById('taskId').value = '';
            document.getElementById('method').value = 'POST';
            document.getElementById('submitBtn').textContent = 'Add Task';
            document.getElementById('submitBtn').classList.remove('bg-[#FFB46F]', 'hover:bg-[#F5A86A]');
            document.getElementById('submitBtn').classList.add('bg-[#6FCBFF]', 'hover:bg-[#5BB8E8]');
            document.getElementById('cancelBtn').classList.add('hidden');
            document.getElementById('addTaskForm').action = '/tasks';
        }

        function completeTask(taskId) {
            if (!confirm('Apakah Anda yakin ingin menandai task ini sebagai selesai?')) {
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/tasks/${taskId}/done`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('input[name="_token"]').value;

            // PATCH
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';

            // semua field ke form
            form.appendChild(csrfToken);
            form.appendChild(methodField);

            // form ke document dan submit
            document.body.appendChild(form);
            form.submit();
        }

        function deleteTask(taskId) {
            if (!confirm('Apakah Anda yakin ingin menghapus task ini?')) {
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/tasks/${taskId}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('input[name="_token"]').value;

            // DELETE
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            // semua field ke form
            form.appendChild(csrfToken);
            form.appendChild(methodField);

            // form ke document dan submit
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>
