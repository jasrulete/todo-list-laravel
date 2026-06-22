<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/todos/{{ $todo->id }}" method="POST">
        @csrf
        <input type="text" name="task" value="{{ $todo->task }}" required>
        <input type="date" name="due_date" value="{{ $todo->due_date?->format('Y-m-d') }}">
        <select name="priority">
            <option value="low" @selected($todo->priority == 'low')>Low</option>
            <option value="medium" @selected($todo->priority == 'medium')>Medium</option>
            <option value="high" @selected($todo->priority == 'high')>High</option>
        </select>
        <button type="submit">Save</button>
    </form>

    <a href="/">Cancel</a>
</body>
</html>