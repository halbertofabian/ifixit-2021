<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h3 class="display-5">Personaliza tus mensajes</h3>
        <p class="lead">En este módulo personalizarás los mensajes que se van a enviar a tus clientes vía WhatsApp y correo electrónico.</p>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mensajes personalizados</h5>
                    <h3 class="card-text">Intrucciones:</h3>
                    <p class="card-text">Las palabras que entran encerradas en <strong>[]</strong> son claves. La api de whatsapp no permite caracteres especiales, evite agregar cualquier carácter especial para el buen funcionamiento de la misma. Los asteriscos <strong>*</strong>, son parte de whatsapp, ayuda a escribir un texto en <strong>negrita</strong>, para más información <a href="https://faq.whatsapp.com/es/android/26000002/" target="_blank"> API Whatsapp</a></p>
                    <p class="card-text"><strong class="card-text">Claves admitidas:</strong></p>
                    <strong class="card-text">[NOMBRE]</strong> Obtiene el nombre del cliente (Importante)<br>
                    <strong class="card-text">[ORDEN]</strong> Obtiene el número de orden del servicio (Importante)<br>
                    <strong class="card-text">[NOTA-S]</strong> Obtiene la nota del servicio que el personal dejo.<br>
                    <strong class="card-text">[TICKET-S]</strong> Obtiene un link publico para consultar el ticket de servicio en tamaño carta.<br>
                    <strong class="card-text">[FACEBOOK]</strong> Obtiene el enlace de facebook<br>
                    <strong class="card-text">[INSTAGRAM]</strong> obtiene el enlace de instagram<br>
                    <strong class="card-text">[TWITTER]</strong> Obtiene el enlace de twitter <br>
                    <strong class="card-text">[YOUTUBE]</strong> Obtiene el enlace de youtube <br>
                    <strong class="card-text">[SUCURSAL]</strong> Obtiene el nombre la sucursal <br>
                    <strong class="card-text">[CODIGO]</strong> Obtiene el código de tiket del servicio <br>
                    <strong class="card-text">[SITO-WB]</strong> Obtiene el enlace de su sitio web <br>
                    <strong class="card-text">[TEL]</strong> Obtiene el número de su whatsapp <br>
                    <strong class="card-text">Nota:</strong> Lo que no tengas registrado como por ejemplo redes sociales lo puedes omitir.

                </div>

                <div class="card-footer">
                    <a href="https://es.piliapp.com/facebook-symbols/" target="_black">Emojis utilizados</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Configuración del correo</h5>
                    <p class="card-text">¿Tienes un servidor de correo?</p>
                    <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                        <label class="btn btn-light active">
                            <input type="radio" name="options" id="optionIsMail1"> No
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="options" id="optionIsMail2"> Si
                        </label>
                    </div>

                    <div class="card d-none">
                        <div class="card-body">
                            <h5 class="card-title">LLena los datos de tu servidor de correo</h5><br>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="my-input">Host smtp</label>
                                    <input id="my-input" class="form-control" type="text" placeholder="Ejemplo: smtp.gmail.com" name="">
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Username</label>
                                    <input id="my-input" class="form-control" type="text" placeholder="Ejemplo: correo@gmail.com" name="">
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Password</label>
                                    <input id="my-input" class="form-control" type="password" placeholder="" name="">
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Puerto</label>
                                    <input id="my-input" class="form-control" type="password" placeholder="Ejemplo: 587" name="">
                                </div>
                                <div class="form-group">
                                    <label for="my-input">De:</label>
                                    <input id="my-input" class="form-control" type="text" placeholder="Ejemplo: <?php echo $_SESSION['nom_suc'] ?>" name="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Introduce el nombre del remitente</h5><br>
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="my-input">De:</label>
                                    <input id="my-input" class="form-control" type="text" placeholder="Ejemplo: <?php echo $_SESSION['nom_suc'] ?>" value="<?php echo $_SESSION['nom_suc'] ?>" name="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-12">

            <?php

            $text = ModeloConfiguracion::mdlObtenerTextos();
            //echo "<pre>", print_r($text), "</pre>";
            $contArray = count($text);


            ?>

            <div class="row">
                <?php for ($i = 0; $i < $contArray; $i++) : ?>

                    <div class="col-md-3 col-12">

                        <div class="card-body">
                            <label for="">Estado: <strong class="text-dark"><?php echo $text[$i]['atributo'] ?></strong></label>
                            <textarea class="form-control text_msj" idText="<?php echo $text[$i]['id'] ?>" cols="30" rows="10"><?php echo $text[$i]['valor'] ?></textarea>
                        </div>

                    </div>
                <?php endfor; ?>

            </div>


        </div>

    </div>
</div>