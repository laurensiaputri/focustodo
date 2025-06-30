<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
        }

        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #555;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Edit Tugas</h2>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <label>Judul Tugas</label>
        <input type="text" name="title" value="{{ $task->title }}" required>

        <label>Deskripsi</label>
        <textarea name="description">{{ $task->description }}</textarea>

        <label>Prioritas</label>
        <select name="priority" required>
            <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }}>High</option>
            <option value="Medium" {{ $task->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }}>Low</option>
        </select>

        <label>Kategori</label>
        <select name="category" required>
            <option value="Sekolah" {{ $task->category === 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
            <option value="Study" {{ $task->category === 'Study' ? 'selected' : '' }}>Study</option>
            <option value="Pekerjaan" {{ $task->category === 'Pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
            <option value="Personal" {{ $task->category === 'Personal' ? 'selected' : '' }}>Personal</option>
        </select>

        <label>Deadline</label>
        <input type="date" name="deadline" value="{{ $task->deadline }}">

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('dashboard') }}">← Kembali</a>
    </form>

</body>
</html>
