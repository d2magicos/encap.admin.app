<main class="container-fluid mx-0 px-0 pt-5 mt-5 bg-body">
    <div class="container my-md-5 py-md-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-lg-3 d-none d-md-block" id="image">
            </div>
            <div class="col-md-8 col-lg-7 bg-white rounded-3 p-5 d-flex justify-content-center align-items-center">
                <form id="form" method="POST">
                    <div class="row">
                        <label class="text-primary mb-2" style="font-size: 35px;">CONTÁCTANOS</label>
                        <label class="fs-5 mb-4">Si tiene alguna consulta por favor, escribenos.</label>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="num_docu" name="num_docu" placeholder="DNI o RUC" minlength="8" maxlength="12" autocomplete="off">
                                <label for="num_docu">DNI o RUC</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" autocomplete="off">
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" maxlength="12" autocomplete="off">
                                <label for="celular">Celular</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" autocomplete="off">
                                <label for="email">Correo electrónico</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje" style="width: 100%; height: 150px;" autocomplete="off"></textarea>
                                <label for="mensaje">Mensaje</label>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fs-5 px-4" id="btn_send">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>