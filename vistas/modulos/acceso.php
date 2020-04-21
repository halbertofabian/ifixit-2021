<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h3 class="display-5">Perfiles dinamicos</h3>
        <p class="lead">Te damos el control darles acceso a tus usuarios de acuerdo a tu gusto con los perfiles dinamicos, 100% creados por ti.</p>
        <button class="btn btn-dark float-right"><i class="fas fa-plus"></i>Agregar perfil</button>
    </div>
</div>

<div class="container-fluid">
    <?php

    if (isset($rutas[1]) && $rutas[1] == "agregar") :
    ?>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Perfiles dinámicos</h3>
                    <p class="card-text"></p>
                    <div class="row">
                        <div class="col-12">
                            <p>Módulos</p>
                        </div>
                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-personalizacion" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-personalizacion">Personalización</label>
                            </div>
                            <div class="row module-personalizacion">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-01-ver" name="m-01-ver">
                                        <label class="custom-control-label" for="m-01-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-01-mod" name="m-01-mod">
                                        <label class="custom-control-label" for="m-01-mod">Modificar</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-usuario" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-usuario">Usuarios</label>
                            </div>
                            <div class="row module-usuario">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-02-ver" name="m-02-ver">
                                        <label class="custom-control-label" for="m-02-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-02-agregar" name="m-02-agregar">
                                        <label class="custom-control-label" for="m-02-agregar">Agregar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-02-mod" name="m-02-mod">
                                        <label class="custom-control-label" for="m-02-mod">Modificar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-02-eli" name="m-02-eli">
                                        <label class="custom-control-label" for="m-02-eli">Eliminar</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-categorias" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-categorias">Categorías</label>
                            </div>
                            <div class="row module-categorias">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-03-ver" name="m-03-ver">
                                        <label class="custom-control-label" for="m-03-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-03-agregar" name="m-03-agregar">
                                        <label class="custom-control-label" for="m-03-agregar">Agregar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-03-mod" name="m-03-mod">
                                        <label class="custom-control-label" for="m-03-mod">Modificar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-03-eli" name="m-03-eli">
                                        <label class="custom-control-label" for="m-03-eli">Eliminar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-03-exp" name="m-03-exp">
                                        <label class="custom-control-label" for="m-03-exp">Exportar</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-productos" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-productos">Productos</label>
                            </div>
                            <div class="row module-productos">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-04-ver" name="m-04-ver">
                                        <label class="custom-control-label" for="m-04-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-04-agregar" name="m-04-agregar">
                                        <label class="custom-control-label" for="m-04-agregar">Agregar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-04-mod" name="m-04-mod">
                                        <label class="custom-control-label" for="m-04-mod">Modificar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-04-eli" name="m-04-eli">
                                        <label class="custom-control-label" for="m-04-eli">Eliminar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-04-exp" name="m-04-exp">
                                        <label class="custom-control-label" for="m-04-exp">Exportar</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-intercambio" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-intercambio">Intercambio de inventario</label>
                            </div>
                            <div class="row module-intercambio">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-05-ver" name="m-05-ver">
                                        <label class="custom-control-label" for="m-05-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-05-agregar" name="m-05-agregar">
                                        <label class="custom-control-label" for="m-05-agregar">Hacer traspaso</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-05-ver-reporte" name="m-05-ver-reporte">
                                        <label class="custom-control-label" for="m-05-ver-reporte">Ver reporte</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="module-caja" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <label class="custom-control-label" for="module-caja">Caja</label>
                            </div>
                            <div class="row module-caja">
                                <div class="col-12 ml-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-06-ver" name="m-06-ver">
                                        <label class="custom-control-label" for="m-06-ver">Ver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="m-06-agregar" name="m-06-agregar">
                                        <label class="custom-control-label" for="m-06-agregar">Hacer venta</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>


    <?php else : ?>


    <?php endif; ?>





</div>