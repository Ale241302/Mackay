<!doctype html>
<html lang="en">

<head>
    <title>Mackay</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('assets/logo.jpg') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/estilos2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .gradient-custom-2 {
            background: #ffffff;
            /* Cambia el fondo a blanco */
        }


        .custom-toggle-password {
            height: 100%;
            /* Ajusta la altura al 100% del contenedor */
            font-size: 1.2rem;
            /* Ajusta el tamaño del icono según sea necesario */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .permission-checkbox {
            margin-right: 10px;
            /* Espacio a la derecha del checkbox */
        }

        .form-check-label {
            margin-left: 5px;
            /* Espacio a la izquierda de la etiqueta del checkbox */
        }

        #forgotPasswordModal3 {
            margin: auto;
            /* Add this to center the modal horizontally */
            top: 68%;
            /* Add this to center the modal vertically */
            transform: translateY(-50%);
            /* Add this to center the modal vertically */
            position: absolute;
            right: 75px;
        }

        .logo-container {
            position: relative;
            top: 100px;
            z-index: 2;
            /* Asegura que el logo esté por encima del barco */
        }

        .img-logo {
            width: 300px;
            height: auto;
            margin-left: -50px;
        }

        .image-container {
            position: relative;
            margin-top: -65px;
            /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
            z-index: 1;
            /* Asegura que el barco esté debajo del logo */
        }

        .img-barco {
            width: 555px;
            height: 56 5px;
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (max-width: 1399px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }

            .img-barco {
                width: 500px;
                height: 80 5px;
            }

            .permission-checkbox {
                margin-right: 10px;
                /* Espacio a la derecha del checkbox */
            }

            .form-check-label {
                margin-left: 5px;
                /* Espacio a la izquierda de la etiqueta del checkbox */
            }

            #forgotPasswordModal3 {
                margin: auto;
                /* Add this to center the modal horizontally */
                top: 73%;
                /* Add this to center the modal vertically */
                transform: translateY(-50%);
                /* Add this to center the modal vertically */
                position: absolute;
                right: 75px;
            }

            .logo-container {
                position: relative;
                top: 100px;
                z-index: 2;
                /* Asegura que el logo esté por encima del barco */
            }

            .img-logo {
                width: 300px;
                height: auto;
                margin-left: -50px;
            }

            .image-container {
                position: relative;
                margin-top: -65px;
                /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
                z-index: 1;
                /* Asegura que el barco esté debajo del logo */
            }
        }

        @media (max-width: 991px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }

            .img-barco {
                width: 370px;
                height: 600px;
            }

            .img-logo {
                width: 300px;
                height: auto;
                margin-left: -50px;
            }


            .logo-container {
                top: 0;
                z-index: 2;
                /* Asegura que el logo esté por encima del barco */
                text-align: center;
                margin-bottom: -40px;
                /* Añade espacio debajo del logo */
            }

            .image-container {
                display: flex;
                position: relative;
                margin-top: -65px;
                /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
                z-index: 1;
                /* Asegura que el barco esté debajo del logo */
            }

            .card-body {
                display: flex;
                position: relative;
                margin-top: -630px;
                /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
                z-index: 1;
                left: 330px;
            }

            .col-lg-6 {
                order: 2;
                /* Hace que el texto esté al lado de la imagen */
            }

            .image-container {
                order: 1;
                /* Hace que la imagen esté al lado del texto */
            }

            #forgotPasswordModal3 {
                margin: auto;
                /* Add this to center the modal horizontally */
                top: 71%;
                /* Add this to center the modal vertically */
                transform: translateY(-50%);
                /* Add this to center the modal vertically */
                position: absolute;
                right: 345px;
            }
        }

        @media (max-width: 767px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }

            .img-logo {
                width: 200px;
                height: auto;
                margin-left: -50px;
            }

            .img-barco {
                width: 250px;
                height: 550px;
            }

            .logo-container {
                top: 0;
                z-index: 2;
                /* Asegura que el logo esté por encima del barco */
                text-align: center;
                margin-bottom: -70px;
                /* Añade espacio debajo del logo */
            }

            .image-container {
                display: flex;
                position: relative;
                margin-top: -25px;
                /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
                z-index: 1;
                /* Asegura que el barco esté debajo del logo */
            }

            .card-body {
                display: flex;
                position: relative;
                margin-top: -580px;
                /* Ajusta el margin-top si necesitas mover el barco hacia arriba */
                z-index: 1;
                left: 240px;
            }

            .col-lg-6 {
                order: 2;
                /* Hace que el texto esté al lado de la imagen */
            }

            .image-container {
                order: 1;
                /* Hace que la imagen esté al lado del texto */
            }

            #forgotPasswordModal3 {
                margin: auto;
                /* Add this to center the modal horizontally */
                top: 73%;
                /* Add this to center the modal vertically */
                transform: translateY(-50%);
                /* Add this to center the modal vertically */
                position: absolute;
                right: 245px;
            }
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="text-center logo-container">
                                <img src="{{ asset('assets/logo.jpg') }}" class="img-logo" alt="logo">
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 image-container">
                                <img src="{{ asset('assets/barco.png') }}" class="img-barco" alt="barco">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">


                                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                                        @csrf
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                        <label class="form-label" for="email"
                                            style="font-weight: bold; font-size: 25px;">Bienvenido</label>
                                        <br />
                                        <span class="form-label" style="font-size: 12px;">Comencemos!!!</span>
                                        <br />
                                        <br />
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Correo</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Ingrese su correo" value="{{ old('email') }}" required />
                                            @error('email')
                                                <div class="text-danger">Error: correo o contraseña inválidos</div>
                                            @enderror
                                            <div class="error-message text-danger" id="emailError"></div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    required />
                                                @error('password')
                                                    <div class="text-danger">Error: correo o contraseña inválidos</div>
                                                @enderror
                                                <div class="input-group-append">
                                                    <span class="input-group-text custom-toggle-password"
                                                        id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <br />
                                            <a class="text-muted" href="#" id= "forgotPasswordModal3"
                                                data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Olvidé
                                                Contraseña</a>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Iniciar
                                                sesion</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="statusMessage"></div>
                    <form id="forgotPasswordForm">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Correo</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Correo Electronico" required />
                        </div>
                        <div class="text-center pt-1 mb-5 pb-1">
                            <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Enviar enlace de
                                recuperación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);

            fetch("{{ route('password.email') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    let statusMessage = document.getElementById('statusMessage');
                    if (data.message) {
                        statusMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    } else {
                        statusMessage.innerHTML = `<div class="alert alert-danger">${data.errors.email}</div>`;
                    }
                    form.reset();
                })
                .catch(error => {
                    let statusMessage = document.getElementById('statusMessage');
                    statusMessage.innerHTML =
                        `<div class="alert alert-danger">Ocurrió un error. Inténtalo de nuevo más tarde.</div>`;
                });
        });
    </script>

    <script src="{{ asset('assets/script.login.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
