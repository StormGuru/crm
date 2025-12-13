<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявка #{{ $ticket->id }}</title>
</head>
<body>

<h1>Заявка № {{ $ticket->id }}</h1>

<h3>Клиент</h3>
<p><strong>Имя:</strong> {{ $ticket->customer->name }}</p>
<p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
<p><strong>Телефон:</strong> {{ $ticket->customer->phone }}</p>

<hr>

<h3>Заявка</h3>
<p><strong>Тема:</strong> {{ $ticket->subject }}</p>
<p><strong>Текст:</strong></p>
<p>{{ $ticket->text }}</p>

<p><strong>Статус:</strong> {{ $ticket->status }}</p>
<p><strong>Создана:</strong> {{ $ticket->created_at }}</p>

<hr>

<a href="/admin/tickets">← Назад к списку</a>

<h3>Сменить статус</h3>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">
    @csrf
    @method('PATCH')

    <select name="status">
        <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>Новый</option>
        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>В работе</option>
        <option value="processed" {{ $ticket->status == 'processed' ? 'selected' : '' }}>Обработан</option>
    </select>

    <button type="submit">Сохранить</button>
</form>


</body>
</html>
