function favoritar(elemento, idReceita) {
    fetch('PHP/favoritar_receita.php?id=' + idReceita)
    .then(response => response.json())
    .then(data => {
        const coracao = elemento.querySelector('span');

        if (data.status === 'success') {
            if (data.message.includes('favoritada')) {
                coracao.innerHTML = '❤';
                coracao.style.color = '#e74c3c';
            } else {
                coracao.innerHTML = '🤍';
                coracao.style.color = 'white';
            }
        } else if (data.status === 'error') {
            alert(data.message);
            if (data.message.includes('login')) {
                window.location.href = 'login.php';
            }
        }
    })
    .catch(error => console.error('Erro:', error));
}