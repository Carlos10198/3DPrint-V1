<?php
?>

<div class="container mt-5">
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
    <p>Você está logado no sistema.</p>
    <a href="/logout" class="btn btn-danger">Sair</a>
</div>