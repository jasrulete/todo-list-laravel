<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My To-Do List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/todos" method="POST">
                @csrf
                <input type="text" name="task" placeholder="New task..." required>
                <input type="date" name="due_date">
                <select name="priority">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
                <button type="submit">Add</button>
            </form>

            <ul>
                @foreach ($todos as $todo)
                    <li>
                        @if ($todo->done)
                            <s>{{ $todo->task }}</s>
                        @else
                            {{ $todo->task }}
                        @endif
                        ({{ $todo->priority }}@if($todo->due_date) — due {{ $todo->due_date->format('M d, Y') }}@endif)

                        <a href="/todos/{{ $todo->id }}/edit">Edit</a>

                        <form action="/todos/{{ $todo->id }}/toggle" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">{{ $todo->done ? 'Undo' : 'Done' }}</button>
                        </form>

                        <form action="/todos/{{ $todo->id }}/delete" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</x-app-layout>