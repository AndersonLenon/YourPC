<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts List</title>
</head>
<body>
    <h1>Lista de Peças</h1>

    <div id="parts-list">
        <!-- Aqui será carregada a lista de peças -->
    </div>

    <script>
        // Usando Fetch API para consumir a API do Laravel
        fetch('http://localhost:8000/api/parts')
            .then(response => response.json())
            .then(data => {
                const partsList = document.getElementById('parts-list');
                data.data.forEach(part => {
                    const partElement = document.createElement('div');
                    partElement.innerHTML = `
                        <h2>${part.name}</h2>
                        <p>Categoria: ${part.category}</p>
                        <p>Preço: R$ ${part.price}</p>
                        <img src="${part.image}" alt="${part.name}" style="width: 100px;">
                    `;
                    partsList.appendChild(partElement);
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
