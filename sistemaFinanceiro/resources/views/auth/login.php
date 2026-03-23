<?php

?>
<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="left col-md-6 d-flex align-items-center justify-content-center">
            <div style="width: 100%; max-width: 400px;">
                <p class="login-3d fs-5"> 3D PRINTING & LASER</p>
                <h1 class="login-bemVindo mb-5 d-flex align-items-center justify-content-center ">Bem-vindo<strong class="login-ponto">.</strong></h1>
                
                <form action="" method="">
                    <div class="mb-3">
                        <label class="form-label fs-5">Usuário</label>
                        <input type="text" class="form-control py-2 fs-6">
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label fs-5">Senha</label>
                            <div class="position-relative">
                                <input type="password" name="senha" id="senhaInput" class="form-control py-2 fs-6">
                                <i class="bi bi-eye-slash position-absolute" 
                                style="right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 1.2rem;"
                                onclick="eyesPassword()"></i>
                            </div>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rememberMeSwitch">
                        <label class="form-check-label" for="rememberMeSwitch">Lembre de mim</label>
                    </div>

                    <div class="d-flex justify-content-center mb-3">
                        <button type="submit" class="btn btnLogin btn-lg w-100 mt-3">
                            LOGIN
                        </button>
                    </div>
                </form>
                <p class="login-sistemaInterno mt-4 d-flex justify-content-end">sistema interno - acesso restrito </p>
            </div>
        </div>

        <div class="right col-md-6 d-none d-md-flex align-items-center justify-content-center">
        <div id="particles-js"></div>    
        <img src="assets/img/logoSemNome.png" class="img-fluid" >
        </div>
    </div>
</div>
