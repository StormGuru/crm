<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список заявок</title>
</head>
<body>

<h1>Заявки</h1>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Тема</th>
            <th>Статус</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->customer->email }}</td>
                <td>{{ $ticket->customer->phone }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->created_at }}</td>
                <td>
                  <a href="{{ route('admin.tickets.show', $ticket) }}">Посмотреть</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
