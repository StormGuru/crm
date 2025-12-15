<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Оставьте заявку</h2>

    <div id="successMessage" class="text-green-600 mb-4 hidden"></div>
    <div id="errorMessage" class="text-red-600 mb-4 hidden"></div>

    <form id="ticketForm" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="name" placeholder="Имя" required
               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="email" name="email" placeholder="Email" required
               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="tel" name="phone" placeholder="Телефон" required
               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="text" name="subject" placeholder="Тема" required
               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <textarea name="text" placeholder="Сообщение" rows="5" required
                  class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                  <div>
       <label>Файлы</label><br>
       <input type="file" name="files[]" multiple>
       </div>
        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">
            Отправить
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ticketForm');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';
        successMessage.textContent = '';

        const formData = new FormData(form);

        try {
           const response = await fetch('/api/tickets', {
           method: 'POST',
           body: formData,
           headers: {
           'Accept': 'application/json'
           } 
       });


            if (!response.ok) {
                const result = await response.json();
                if (result.errors) {
                    const errors = Object.values(result.errors).flat().join(', ');
                    errorMessage.textContent = errors;
                } else {
                    errorMessage.textContent = 'Произошла ошибка. Попробуйте позже.';
                }
                errorMessage.classList.remove('hidden');
            } else {
                successMessage.textContent = 'Заявка успешно отправлена!';
                successMessage.classList.remove('hidden');
                form.reset();
            }
        } catch (err) {
            errorMessage.textContent = 'Произошла ошибка. Попробуйте позже.';
            errorMessage.classList.remove('hidden');
        }
    });
});
</script>

</body>
</html>
