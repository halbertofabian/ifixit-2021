<?php
if ($_SESSION['perfil'] == "Tecnico") {
  echo '<script>

	window.location = "./inicio";

</script>';
  return;
}
?>
<?php
if ($_SESSION['perfil'] == "Administrador" || $_SESSION['perfil'] == "Vendedor") :
  if (isset($_GET['editarServicio'])) :
    $serv = ControladorServicios::ctrDetalleServicio($_GET['editarServicio']);
    $estado_equipo = $serv['estado_equipo'];
    //var_dump($serv);
    $contacto = $serv['contacto'];
    //echo $contacto.'<br>';
    $array = array();
    $array = explode("/", $contacto);
    //echo $array[0].'<br>';
    $wp =  $array[1];
    $array = explode(" ", $array[0]);
    $tel  = $array[0] . $array[1];
    $correo = $array[2];

    // echo $wp.'<br>';
    // echo substr($wp, 0, 2);
    // echo substr($wp, 2, 10);
    // echo $tel.'<br>';
    // echo $correo.'<br>';

?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h3 class="display-5">Modificación de servicios</h3>
      </div>
    </div>


    <!-- Main content -->
    <section class="container">
      <?php if ($serv['estado_corte'] != 0) : $estado_equipo = "Reparacion"; ?>

        <!-- <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="alert alert-warning">
                  Esta orden de servicio anteriormente reportó actividad
                  en el corte o ya fue entregado, si se módifica esta orden volvera a contar desde 0,
                  es decir se sumara a la cuenta actual el monto de anticipo y el estado de servicio pasara ha <strong>Reparación</strong>
                </div>
              </div>
            </div>
          </div> -->


      <?php endif; ?>

      <form action="" method="post">
        <input type="hidden" name="estado_equipo" value="<?php echo $estado_equipo ?>">
        <div class="row">
          <div class="col-md-4 col-12">
            <label for="">Numero de orden <span class="text-success">(*)</span></label>

            <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="<?php echo $serv['orden'] ?>">



          </div>
          <div class="col-md-8">
            <label for="">Nombre <span class="text-success">(*)</span></label>
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" value="<?php echo $serv['nombre'] ?>">
          </div>

        </div>
        <div class="row">
          <div class="col-md-2">
            <label for="">Tel</label>
            <input type="text" class="form-control" name="contacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" value="<?php echo $tel ?>" data-mask id="contacto">

          </div>
          <div class="col-md-3">
            <label for="">Email</label>
            <input type="text" class="form-control" placeholder="Correo" name="email" value="<?php echo $correo ?>" id="email">
          </div>
          <div class="col-md-1">
            <label for="">Código</label>
            <input type="text" class="form-control" placeholder="52" name="codigo-wp" pattern="\d*" value="<?php echo substr($wp, 0, 2); ?>" id="codigo">
          </div>
          <div class="col-md-2">
            <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
            <input type="text" class="form-control" placeholder="0000000000" name="numero-wp" pattern="\d*" value="<?php echo substr($wp, 2, 10); ?>" id="wsp">
          </div>
          <div class="col-md-3">
            <label for="">Fecha <span class="text-success">(*)</span></label>
            <input type="date" class="form-control" required="" name="fecha_reparacion" id="theDate">
          </div>

        </div>

        <br>
        <div class="row">

          <div class="col-md-3 col-12">
            <div class="form-group">
              <label for="tecnico">Técnico Asignado</label>
              <?php

              $date =  $serv['fecha_prometida'];

              $fecha = array();

              $fecha = explode(' ', $date);

              $fecha_prometida = $fecha[0];
              $hora_prometida = $fecha[1];


              ?>
              <select id="tecnico" class="form-control mySelect2" data-placeholder="Seleccione un técnico(Opcional)" name="tecnico">
                <option value="<?php echo  $serv['tecnico'] ?>"><?php echo $serv['tecnico'] ?></option>

                <?php

                $tecnicos = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();
                foreach ($tecnicos as $key => $value) :
                ?>



                  <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>

                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-2 col-12">
            <div class="form-group">
              <label for="fecha_prometida">Fecha de entrega prometida</label>
              <input id="fecha_prometida" class="form-control " type="date" name="fecha_prometida" value="<?php echo  $fecha_prometida ?>">


            </div>
          </div>
          <div class="col-md-2 col-12">
            <div class="form-group">
              <label for="hora_prometida">Hora de entrega prometida</label>

              <input id="hora_prometida" class="form-control " type="time" name="hora_prometida" value="<?php echo  $hora_prometida ?>">

            </div>
          </div>
        </div>

        <div class="row">


          <div class="col-md-2">
            <strong>Descripción del equipo <span class="text-success">(*)</span></strong><br>
            <label for="">Equipo</label>
            <select id="" class="form-control" name="equipo">
              <option value="<?php echo $serv['equipo'] ?>"><?php echo $serv['equipo'] ?></option>
              <option value="Celular">Celular</option>
              <option value="Computadora">Computadora</option>
              <option value="Laptop">Latop</option>

              <option value="Tablet">Tablet</option>
              <option value="Consola">Consola</option>
              <option value="Consola">Otro</option>

            </select>
          </div>
          <div class="col-md-2">
            <br>
            <label for="">IMEI/ Número de Serie</label>
            <input type="text" class="form-control" placeholder="Imei/Serie" name="imei" value="" value="<?php echo $serv['imei'] ?>">
          </div>
          <div class="col-md-2">
            <br>
            <label for="">Marca <span class="text-success">(*)</span></label>
            <input type="text" class="form-control" placeholder="Marca" name="marca" required="" value="<?php echo $serv['marca'] ?>">
          </div>
          <div class="col-md-2">
            <br>
            <label for="">Modelo <span class="text-success">(*)</span></label>
            <input type="text" class="form-control" placeholder="Modelo" name="modelo" required="" value="<?php echo $serv['modelo'] ?>">
          </div>
          <div class="col-md-2">
            <br>
            <label for="">Color</label>
            <input type="text" class="form-control" placeholder="Color" name="color" value="<?php echo $serv['color'] ?>">
          </div>
          <div class="col-md-2">
            <br>
            <label for="">Observaciones</label>
            <input type="text" class="form-control" placeholder="Observaciones" name="observaciones" value="<?php echo $serv['observaciones'] ?>">
          </div>
        </div>
        <br>
        <div class="row">

          <div class="col-12 col-md-12 ">
            <div class="text-warning alert alert-dark text-center">
              <strong>*Por seguridad vuelva a seleccionar al menos una opcion de éstas <span class="text-success">(*)</span></strong>

            </div>


          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Encendido"> Encendido
          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Apagado"> Apagado
          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Manipulado"> Manipulado
          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Mojado"> Mojado
          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Roto"> Roto
          </div>
          <div class="col-md-2">
            <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Incompleto"> Incompleto
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <label for="">Descripción del problema <span class="text-success">(*)</span></label>
            <textarea id="" cols="30" rows="5" class="form-control" name="problema" required=""><?php echo $serv['problema'] ?></textarea>
          </div>
          <div class="col-md-6">
            <label for="">Solución (opcional)</label>
            <textarea id="" cols="30" rows="5" class="form-control" name="solucion"><?php echo $serv['solucion'] ?></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-12 col-md-12 text-center">
            <div class="text-warning alert alert-dark">
              <strong>*Por seguridad vuelva a seleccionar una opcion de éstas <span class="text-success">(*)</span></strong>
            </div>
          </div>

          <div class="col-md-6">
            <p>Patron de desbloqueo o Pin Númerico</p>
          </div>
          <div class="col-md-6">
            <p>Estetica</p>
          </div>

        </div>

        <div class="row">

          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="" name="desbloqueo" value="<?php echo $serv['desbloqueo'] ?>">
          </div>

          <div class="col-md-3">

            <input type="radio" class="" name="estetica" value="Bueno"> Bueno

          </div>
          <div class="col-md-3">

            <input type="radio" class="" name="estetica" value="Regular"> Regular

          </div>
          <div class="col-md-3">

            <input type="radio" class="" name="estetica" value="Malo"> Malo

          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="">Importe <span class="text-success">(*)</span></label>
            <input type="text" class="form-control efectivoFormat importe" placeholder="$" required="" name="importe" value="<?php echo $serv['importe'] ?>">
          </div>
          <div class="col-md-4">
            <label for="">Anticipo <span class="text-success">(*)</span> Si requiere módificar el anticipo, ingresa un abono de servicio <a href="entregas">(Entregas)</a></label>
            <input type="text" class="form-control efectivoFormat anticipo" placeholder="$" required="" name="anticipo" value="<?php echo $serv['anticipo'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="">Total <span class="text-success">(*)</span></label>
            <input type="text" class="form-control efectivoFormat total" placeholder="$" required="" name="total" value="<?php echo $serv['total'] ?>">
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-md-4 float-right">
            <input type="submit" value="Modificar" class="btn btn-dark btn-block mb-5" name="btnModificarServicio">
          </div>
        </div>
        <?php

        $servicios = new ControladorServicios();
        $servicios->ctrModificarServicio();
        ?>
      </form>
    </section>

<?php return;
  endif;
endif; ?>

<?php if (isset($_GET['precargado'])) :

  $serv = ControladorServicios::ctrMostrarServcioPrecargado($_GET['precargado']);

?>


  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h3 class="display-5">Servicio Precargado</h3>
    </div>
  </div>
  <!-- Main content -->
  <section class="container">
    <div class="row">
      <div class="col-md-4 text-success"><strong>Campos obligatorios(*)</strong>

        <hr>
        <?php
        $clientes = ControladorClientes::ctrMostrarClientes(null, null); ?>
        <select class="form-control" data-placeholder="Seleccione un cliente(Opcional)" id="mySelect2">
          <option value=""></option>
          <?php foreach ($clientes as $key => $value) : ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['telefono'] ?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <br>
        <button class="btn btn-secondary float-right" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente frecuente

        </button>
      </div>
      <!-- <div class="col-md-4 float-right">
          <form class="form-inline" method="get" action="ajax/presupuestos.ajax.php">

            <div class="form-group mx-sm-3 mb-2">

              <input type="search" class="form-control" id="search" placeholder="Buscar presupuesto" name="serach">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
          </form>
        </div> -->
    </div>
    <form action="" method="post">
      <div class="row mt-2">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Información del cliente
          </div>
        </div>
        <div class="col-md-4 col-12">
          <label for="">Numero de orden <span class="text-success">(*)</span></label>
          <div class="form-group">
            <?php $orden = ControladorServicios::orden();
            if ($orden == false) :
            ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="1010">
            <?php else : ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="<?php echo $orden['orden'] + 1 ?>">
            <?php endif; ?>
          </div>


        </div>
        <div class="col-md-8">
          <label for="">Nombre <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" id="nombre">
        </div>

      </div>
      <div class="row">
        <div class="col-md-2">
          <label for="">Tel</label>
          <input type="text" class="form-control" name="contacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask id="contacto">
        </div>
        <div class="col-md-3">
          <label for="">Email</label>
          <input type="text" class="form-control" placeholder="Correo" name="email" id="email">
        </div>
        <div class="col-md-2">
          <label for="">Código</label>
          <!-- <input type="text" class="form-control" placeholder="52" name="codigo-wp" value="" pattern="\d*" id="codigo"> -->
          <select name="codigo-wp" class="form-control " id="codigo">
            <option value="" selected>Código de país</option>
            <option value="52">Mexico (52)</option>
            <option value="93">Afghanistan (93)</option>
            <option value="355">Albania (355)</option>
            <option value="213">Algeria (213)</option>
            <option value="376">Andorra (376)</option>
            <option value="672">Antarctica (672)</option>
            <option value="54">Argentina (54)</option>
            <option value="374">Armenia (374)</option>
            <option value="61">Australia (61)</option>
            <option value="43">Austria (43)</option>
            <option value="994">Azerbaijan (994)</option>
            <option value="973">Bahrain (973)</option>
            <option value="880">Bangladesh (880)</option>
            <option value="375">Belarus (375)</option>
            <option value="32">Belgium (32)</option>
            <option value="501">Belize (501)</option>
            <option value="229">Benin (229)</option>
            <option value="975">Bhutan (975)</option>
            <option value="591">Bolivia (591)</option>
            <option value="387">Bosnia and Herzegovina (387)</option>
            <option value="267">Botswana (267)</option>
            <option value="55">Brazil (55)</option>
            <option value="673">Brunei (673)</option>
            <option value="359">Bulgaria (359)</option>
            <option value="226">Burkina Faso (226)</option>
            <option value="95">Burma (Myanmar) (95)</option>
            <option value="257">Burundi (257)</option>
            <option value="855">Cambodia (855)</option>
            <option value="237">Cameroon (237)</option>
            <option value="1">Canada (1)</option>
            <option value="238">Cape Verde (238)</option>
            <option value="236">Central African Republic (236)</option>
            <option value="235">Chad (235)</option>
            <option value="56">Chile (56)</option>
            <option value="86">China (86)</option>
            <option value="61">Christmas Island (61)</option>
            <option value="61">Cocos (Keeling) Islands (61)</option>
            <option value="57">Colombia (57)</option>
            <option value="269">Comoros (269)</option>
            <option value="243">Congo (243)</option>
            <option value="682">Cook Islands (682)</option>
            <option value="506">Costa Rica (506)</option>
            <option value="385">Croatia (385)</option>
            <option value="53">Cuba (53)</option>
            <option value="357">Cyprus (357)</option>
            <option value="420">Czech Republic (420)</option>
            <option value="45">Denmark (45)</option>
            <option value="253">Djibouti (253)</option>
            <option value="593">Ecuador (593)</option>
            <option value="20">Egypt (20)</option>
            <option value="503">El Salvador (503)</option>
            <option value="240">Equatorial Guinea (240)</option>
            <option value="291">Eritrea (291)</option>
            <option value="372">Estonia (372)</option>
            <option value="251">Ethiopia (251)</option>
            <option value="500">Falkland Islands (500)</option>
            <option value="298">Faroe Islands (298)</option>
            <option value="679">Fiji (679)</option>
            <option value="358">Finland (358)</option>
            <option value="33">France (33)</option>
            <option value="689">French Polynesia (689)</option>
            <option value="241">Gabon (241)</option>
            <option value="220">Gambia (220)</option>
            <option value="970">Gaza Strip (970)</option>
            <option value="995">Georgia (995)</option>
            <option value="49">Germany (49)</option>
            <option value="233">Ghana (233)</option>
            <option value="350">Gibraltar (350)</option>
            <option value="30">Greece (30)</option>
            <option value="299">Greenland (299)</option>
            <option value="502">Guatemala (502)</option>
            <option value="224">Guinea (224)</option>
            <option value="245">Guinea-Bissau (245)</option>
            <option value="592">Guyana (592)</option>
            <option value="509">Haiti (509)</option>
            <option value="39">Holy See (Vatican City) (39)</option>
            <option value="504">Honduras (504)</option>
            <option value="852">Hong Kong (852)</option>
            <option value="36">Hungary (36)</option>
            <option value="354">Iceland (354)</option>
            <option value="91">India (91)</option>
            <option value="62">Indonesia (62)</option>
            <option value="98">Iran (98)</option>
            <option value="964">Iraq (964)</option>
            <option value="353">Ireland (353)</option>
            <option value="44">Isle of Man (44)</option>
            <option value="972">Israel (972)</option>
            <option value="39">Italy (39)</option>
            <option value="225">Ivory Coast (225)</option>
            <option value="81">Japan (81)</option>
            <option value="962">Jordan (962)</option>
            <option value="7">Kazakhstan (7)</option>
            <option value="254">Kenya (254)</option>
            <option value="686">Kiribati (686)</option>
            <option value="381">Kosovo (381)</option>
            <option value="965">Kuwait (965)</option>
            <option value="996">Kyrgyzstan (996)</option>
            <option value="856">Laos (856)</option>
            <option value="371">Latvia (371)</option>
            <option value="961">Lebanon (961)</option>
            <option value="266">Lesotho (266)</option>
            <option value="231">Liberia (231)</option>
            <option value="218">Libya (218)</option>
            <option value="423">Liechtenstein (423)</option>
            <option value="370">Lithuania (370)</option>
            <option value="352">Luxembourg (352)</option>
            <option value="853">Macau (853)</option>
            <option value="389">Macedonia (389)</option>
            <option value="261">Madagascar (261)</option>
            <option value="265">Malawi (265)</option>
            <option value="60">Malaysia (60)</option>
            <option value="960">Maldives (960)</option>
            <option value="223">Mali (223)</option>
            <option value="356">Malta (356)</option>
            <option value="692">Marshall Islands (692)</option>
            <option value="222">Mauritania (222)</option>
            <option value="230">Mauritius (230)</option>
            <option value="262">Mayotte (262)</option>
            <option value="52">Mexico (52)</option>
            <option value="691">Micronesia (691)</option>
            <option value="373">Moldova (373)</option>
            <option value="377">Monaco (377)</option>
            <option value="976">Mongolia (976)</option>
            <option value="382">Montenegro (382)</option>
            <option value="212">Morocco (212)</option>
            <option value="258">Mozambique (258)</option>
            <option value="264">Namibia (264)</option>
            <option value="674">Nauru (674)</option>
            <option value="977">Nepal (977)</option>
            <option value="31">Netherlands (31)</option>
            <option value="599">Netherlands Antilles (599)</option>
            <option value="687">New Caledonia (687)</option>
            <option value="64">New Zealand (64)</option>
            <option value="505">Nicaragua (505)</option>
            <option value="227">Niger (227)</option>
            <option value="234">Nigeria (234)</option>
            <option value="683">Niue (683)</option>
            <option value="672">Norfolk Island (672)</option>
            <option value="850">North Korea (850)</option>
            <option value="47">Norway (47)</option>
            <option value="968">Oman (968)</option>
            <option value="92">Pakistan (92)</option>
            <option value="680">Palau (680)</option>
            <option value="507">Panama (507)</option>
            <option value="675">Papua New Guinea (675)</option>
            <option value="595">Paraguay (595)</option>
            <option value="51">Peru (51)</option>
            <option value="63">Philippines (63)</option>
            <option value="870">Pitcairn Islands (870)</option>
            <option value="48">Poland (48)</option>
            <option value="351">Portugal (351)</option>
            <option value="1">Puerto Rico (1)</option>
            <option value="974">Qatar (974)</option>
            <option value="242">Republic of the Congo (242)</option>
            <option value="40">Romania (40)</option>
            <option value="7">Russia (7)</option>
            <option value="250">Rwanda (250)</option>
            <option value="590">Saint Barthelemy (590)</option>
            <option value="290">Saint Helena (290)</option>
            <option value="508">Saint Pierre and Miquelon (508)</option>
            <option value="685">Samoa (685)</option>
            <option value="378">San Marino (378)</option>
            <option value="239">Sao Tome and Principe (239)</option>
            <option value="966">Saudi Arabia (966)</option>
            <option value="221">Senegal (221)</option>
            <option value="381">Serbia (381)</option>
            <option value="248">Seychelles (248)</option>
            <option value="232">Sierra Leone (232)</option>
            <option value="65">Singapore (65)</option>
            <option value="421">Slovakia (421)</option>
            <option value="386">Slovenia (386)</option>
            <option value="677">Solomon Islands (677)</option>
            <option value="252">Somalia (252)</option>
            <option value="27">South Africa (27)</option>
            <option value="82">South Korea (82)</option>
            <option value="34">Spain (34)</option>
            <option value="94">Sri Lanka (94)</option>
            <option value="249">Sudan (249)</option>
            <option value="597">Suriname (597)</option>
            <option value="268">Swaziland (268)</option>
            <option value="46">Sweden (46)</option>
            <option value="41">Switzerland (41)</option>
            <option value="963">Syria (963)</option>
            <option value="886">Taiwan (886)</option>
            <option value="992">Tajikistan (992)</option>
            <option value="255">Tanzania (255)</option>
            <option value="66">Thailand (66)</option>
            <option value="670">Timor-Leste (670)</option>
            <option value="228">Togo (228)</option>
            <option value="690">Tokelau (690)</option>
            <option value="676">Tonga (676)</option>
            <option value="216">Tunisia (216)</option>
            <option value="90">Turkey (90)</option>
            <option value="993">Turkmenistan (993)</option>
            <option value="688">Tuvalu (688)</option>
            <option value="256">Uganda (256)</option>
            <option value="380">Ukraine (380)</option>
            <option value="971">United Arab Emirates (971)</option>
            <option value="44">United Kingdom (44)</option>
            <option value="1">United States (1)</option>
            <option value="598">Uruguay (598)</option>
            <option value="998">Uzbekistan (998)</option>
            <option value="678">Vanuatu (678)</option>
            <option value="58">Venezuela (58)</option>
            <option value="84">Vietnam (84)</option>
            <option value="681">Wallis and Futuna (681)</option>
            <option value="970">West Bank (970)</option>
            <option value="967">Yemen (967)</option>
            <option value="260">Zambia (260)</option>
            <option value="263">Zimbabwe (263)</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
          <input type="text" class="form-control" placeholder="0000000000" name="numero-wp" pattern="\d*" id="wsp">
        </div>
        <div class="col-md-3">
          <label for="">Fecha <span class="text-success">(*)</span></label>
          <input type="date" class="form-control" required="" name="fecha_reparacion" id="theDate">
        </div>

      </div>
      <div class="row mt-3">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Información del equipo
          </div>
        </div>
        <div class="col-md-3 col-12">
          <div class="form-group">
            <label for="tecnico">Técnico Asignado</label>
            <select id="tecnico" class="form-control mySelect2" data-placeholder="Seleccione un técnico(Opcional)" name="tecnico">
              <option value=""></option>
              <?php

              $tecnicos = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();
              foreach ($tecnicos as $key => $value) :
              ?>

                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>

              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-12">
          <div class="form-group">
            <label for="fecha_prometida">Fecha de entrega prometida</label>
            <input id="fecha_prometida" class="form-control theDate" type="date" name="fecha_prometida">


          </div>
        </div>
        <div class="col-md-2 col-12">
          <div class="form-group">
            <label for="hora_prometida">Hora de entrega prometida</label>

            <input id="hora_prometida" class="form-control " type="time" name="hora_prometida">

          </div>
        </div>
        <div class="col-md-3 col-12">
          <div class="form-group">
            <label for="usuario_recibio">Usuario recibio</label>
            <select id="usuario_recibio" class="form-control mySelect2" data-placeholder="Seleccione un vendedor" name="usuario_recibio" required>
              <option value="<?php echo $_SESSION["nombre"] ?>"><?php echo $_SESSION["nombre"] ?></option>
              <?php

              $vendedor = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();
              foreach ($vendedor as $key => $value) :
              ?>

                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>

              <?php endforeach; ?>
            </select>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-2">
          <strong>Descripción del equipo <span class="text-success">(*)</span></strong><br>
          <label for="">Equipo</label>
          <select id="" class="form-control" name="equipo">
            <option value="<?php echo $serv['tipo_equipo'] ?>"><?php echo $serv['tipo_equipo'] ?></option>
            <option value="Celular">Celular</option>
            <option value="Computadora">Computadora</option>
            <option value="Tablet">Tablet</option>
            <option value="Consola">Consola</option>
          </select>
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Imei/Serie</label>
          <input type="text" class="form-control" placeholder="Imei/Serie" name="imei" value="">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Marca <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Marca" name="marca" required="" value="<?php echo $serv['marca'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Modelo <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Modelo" name="modelo" required="" value="<?php echo $serv['modelo'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Color</label>
          <input type="text" class="form-control" placeholder="Color" name="color">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Observaciones</label>
          <input type="text" class="form-control" placeholder="Observaciones" name="observaciones">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="text-danger">
            *Seleccione al menos una opcion de estas <span class="text-success">(*)</span>
          </div>
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Encendido"> Encendido
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Apagado"> Apagado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Manipulado"> Manipulado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Mojado"> Mojado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Roto"> Roto
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Incompleto"> Incompleto
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <label for="">Descripción del problema <span class="text-success">(*)</span></label>
          <textarea id="" cols="30" rows="5" class="form-control" name="problema" required=""><?php echo $serv['nombre'] ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="">Solución (opcional)</label>
          <textarea id="" cols="30" rows="5" class="form-control" name="solucion"></textarea>
        </div>
      </div>
      <div class="row">

        <div class="col-md-6 mt-4">
          
          <p>Pin Númerico</p>
        </div>
        <div class="col-md-6">
          <p>Estetica</p>
        </div>

      </div>

      <div class="row">
        <div class="col-12 col-md-12 text-center">
          <div class="text-danger">
            *Seleccione una opcion de estas <span class="text-success">(*)</span>
          </div>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="" name="desbloqueo">
        </div>

        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Bueno"> Bueno

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Regular"> Regular

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Malo"> Malo

        </div>
      </div>
      <div class="row mt-5 mb-5">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Presupuesto
          </div>
        </div>
        <div class="col-md-4">
          <label for="">Importe <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat importe" placeholder="$" required="" name="importe" value="<?php echo $serv['precio'] ?>">
        </div>
        <div class="col-md-4">
          <label for="">Anticipo <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat anticipo" placeholder="$" required="" value="0" name="anticipo">
        </div>
        <div class="col-md-4">
          <label for="">Total <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat total" placeholder="$" required="" name="total" value="<?php echo $serv['precio'] ?>">
        </div>

      </div>

      <div class="row">
        <div class="col-md-4 float-right">
          <input type="submit" value="Guardar" class="btn btn-dark btn-block mb-5" name="btnRegistrarServicio">
        </div>
      </div>
      <?php

      $servicios = new ControladorServicios();
      $servicios->ctrRegistrarServicio();
      ?>
    </form>
  </section>
  <!-- /.content -->

<?php return;
endif; ?>







<?php if (isset($_SESSION['presupuesto']) && $_SESSION['presupuesto'] != "") {

  $servicio = ControladorPresupuestos::ctrDetallePresupuesto($_SESSION['presupuesto']);

?>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h3 class="display-5">Servicio presupuestado</h3>
    </div>
  </div>

  <!-- Main content -->
  <section class="container">
    <div class="row">
      <div class="col-md-4 text-success"><strong>Campos obligatorios(*)</strong>

        <hr>
        <?php
        $clientes = ControladorClientes::ctrMostrarClientes(null, null); ?>
        <select class="form-control" data-placeholder="Seleccione un cliente(Opcional)" id="mySelect2">
          <option value=""></option>
          <?php foreach ($clientes as $key => $value) : ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['telefono'] ?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <br>
        <button class="btn btn-secondary float-right" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente frecuente

        </button>
      </div>

      <div class="col-md-4 float-right">
        <form class="form-inline" method="get" action="ajax/presupuestos.ajax.php">

          <div class="form-group mx-sm-3 mb-2">

            <input type="search" class="form-control" id="search" placeholder="Buscar presupuesto" name="serach" value="<?php echo $_SESSION['presupuesto'] ?>">
          </div>
          <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>
      </div>
    </div>
    <form action="" method="post">
      <div class="row">


        <div class="col-md-4 col-12">
          <label for="">Numero de orden <span class="text-success">(*)</span></label>
          <div class="form-group">
            <?php $orden = ControladorServicios::orden();
            if ($orden == false) :
            ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="1010">
            <?php else : ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="<?php echo $orden['orden'] + 1 ?>">
            <?php endif; ?>
          </div>


        </div>
        <div class="col-md-8">
          <label for="">Nombre <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" value="<?php echo $servicio['nombre'] ?>" id="nombre">
        </div>

      </div>
      <div class="row">
        <div class="col-md-2">
          <label for="">Tel</label>
          <input type="text" class="form-control" name="contacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask id="contacto">
        </div>
        <div class="col-md-3">
          <label for="">Email</label>
          <input type="text" class="form-control" placeholder="Correo" name="email" id="email">
        </div>
        <div class="col-md-1">
          <label for="">Código</label>
          <input type="text" class="form-control" placeholder="52" name="codigo-wp" value="" pattern="\d*" id="codigo">
        </div>
        <div class="col-md-2">
          <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
          <input type="text" class="form-control" placeholder="0000000000" name="numero-wp" pattern="\d*" id="wsp">
        </div>
        <div class="col-md-3">
          <label for="">Fecha <span class="text-success">(*)</span></label>
          <input type="date" class="form-control" required="" name="fecha_reparacion" id="theDate">
        </div>

      </div>

      <div class="row">


        <div class="col-md-2">
          <strong>Descripción del equipo <span class="text-success">(*)</span></strong><br>
          <label for="">Equipo</label>
          <select id="" class="form-control" name="equipo">
            <option value="Celular">Celular</option>
            <option value="Computadora">Computadora</option>
            <option value="Tablet">Tablet</option>
            <option value="Consola">Consola</option>
          </select>
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Imei/Serie</label>
          <input type="text" class="form-control" placeholder="Imei/Serie" name="imei" value="<?php echo $servicio['imei'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Marca <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Marca" name="marca" required="" value="<?php echo $servicio['marca'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Modelo <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Modelo" name="modelo" required="" value="<?php echo $servicio['modelo'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Color</label>
          <input type="text" class="form-control" placeholder="Color" name="color" value="<?php echo $servicio['color'] ?>">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Observaciones</label>
          <input type="text" class="form-control" placeholder="Observaciones" name="observaciones" value="<?php echo $servicio['observaciones'] ?>">
        </div>
      </div>
      <br>
      <div class="row">

        <div class="col-md-2">
          <div class="col-12 col-md-12">
            <div class="text-danger">
              *Seleccione al menos una opcion de estas <span class="text-success">(*)</span>
            </div>
          </div>

          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Encendido"> Encendido
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Apagado"> Apagado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Manipulado"> Manipulado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Mojado"> Mojado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Roto"> Roto
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Incompleto"> Incompleto
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <label for="">Descripción del problema <span class="text-success">(*)</span></label>
          <textarea id="" cols="30" rows="5" class="form-control" name="problema" required=""><?php echo $servicio['diagnostico'] ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="">Solución (opcional)</label>
          <textarea id="" cols="30" rows="5" class="form-control" name="solucion"></textarea>
        </div>
      </div>
      <div class="row">

        <div class="col-md-6">
          <p>Patron de desbloqueo o Pin Númerico</p>
        </div>
        <div class="col-md-6">
          <p>Estetica</p>
        </div>

      </div>

      <div class="row">
        <div class="col-12 col-md-12 text-center">
          <div class="text-danger">
            *Seleccione una opcion de estas <span class="text-success">(*)</span>
          </div>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="" name="desbloqueo">
        </div>

        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Bueno"> Bueno

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Regular"> Regular

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Malo"> Malo

        </div>
      </div>
      <div class="row total">
        <div class="col-md-4">
          <label for="">Importe <span class="text-success">(*)</span></label>
          <input type="number" class="form-control importe" placeholder="$" required="" id="importe" name="importe">
        </div>
        <div class="col-md-4">
          <label for="">Anticipo <span class="text-success">(*)</span></label>
          <input type="number" class="form-control anticipo" placeholder="$" required="" id="anticipo" value="0" name="anticipo">
        </div>
        <div class="col-md-4">
          <label for="">Total <span class="text-success">(*)</span></label>
          <input type="number" class="form-control total" placeholder="$" required="" id="total" name="total">
        </div>

      </div>
      <br>
      <div class="row">
        <!--<div class="col-md-4 pull-left">
                          <input type="reset" value="Cancelar" class="btn btn-danger btn-block" name="">
                        </div>-->
        <div class="col-md-4 float-right">
          <input type="submit" value="Guardar" class="btn btn-dark btn-block mb-5" name="btnRegistrarServicio">
        </div>
      </div>
      <?php
      $servicios = new ControladorServicios();
      $servicios->ctrRegistrarServicio();
      ?>
    </form>
  </section>

<?php } else { ?>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h3 class="display-5">Crear servicio</h3>
    </div>
  </div>


  <!-- Main content -->
  <section class="container">
    <div class="row">

      <div class="col-md-4 text-success">
        <strong>Campos obligatorios(*)</strong>
        <hr>
        <?php
        $clientes = ControladorClientes::ctrMostrarClientes(null, null); ?>
        <select class="form-control" data-placeholder="Seleccione un cliente(Opcional)" id="mySelect2">
          <option value=""></option>
          <?php foreach ($clientes as $key => $value) : ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['telefono'] ?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <br>
        <button class="btn btn-secondary float-right" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente frecuente

        </button>
      </div>
      <!-- <div class="col-md-4 float-right">
          <form class="form-inline" method="get" action="ajax/presupuestos.ajax.php">

            <div class="form-group mx-sm-3 mb-2">

              <input type="search" class="form-control" id="search" placeholder="Buscar presupuesto" name="serach">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
          </form>
        </div> -->
    </div>
    <form action="" method="post">


      <br>
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Información del cliente
          </div>
        </div>
        <div class="col-md-4 col-12">
          <label for="">Numero de orden <span class="text-success">(*)</span></label>
          <div class="form-group">
            <?php $orden = ControladorServicios::orden();
            if ($orden == false) :
            ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="1000">
            <?php else : ?>
              <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="<?php echo $orden['orden'] + 1 ?>">
            <?php endif; ?>
          </div>


        </div>
        <div class="col-md-8">
          <label for="">Nombre <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" id="nombre">
        </div>

      </div>
      <div class="row">
        <div class="col-md-3">
          <label for="">Tel</label>
          <input type="text" class="form-control mandarWP" name="contacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask id="contacto">

          <br>
          <div class="float-right">

            <div class="form-group">
              <button type="button" class="btn btn-primary " id="pasarWP">

                <i class="fas fa-copy"></i>

              </button>
            </div>

          </div>

        </div>

        <div class="col-md-3">
          <label for="">Email</label>
          <input type="text" class="form-control" placeholder="Correo" name="email" id="email">
        </div>
        <div class="col-md-2">
          <label for="">Código (Lada país)</label>
          <!-- <input type="text" class="form-control" placeholder="" name="codigo-wp" value="" pattern="\d*" id="codigo"> -->
          <select name="codigo-wp" class="form-control " id="codigo">
            <option value="" selected>Código de país</option>
            <option value="52">Mexico (52)</option>
            <option value="93">Afghanistan (93)</option>
            <option value="355">Albania (355)</option>
            <option value="213">Algeria (213)</option>
            <option value="376">Andorra (376)</option>
            <option value="672">Antarctica (672)</option>
            <option value="54">Argentina (54)</option>
            <option value="374">Armenia (374)</option>
            <option value="61">Australia (61)</option>
            <option value="43">Austria (43)</option>
            <option value="994">Azerbaijan (994)</option>
            <option value="973">Bahrain (973)</option>
            <option value="880">Bangladesh (880)</option>
            <option value="375">Belarus (375)</option>
            <option value="32">Belgium (32)</option>
            <option value="501">Belize (501)</option>
            <option value="229">Benin (229)</option>
            <option value="975">Bhutan (975)</option>
            <option value="591">Bolivia (591)</option>
            <option value="387">Bosnia and Herzegovina (387)</option>
            <option value="267">Botswana (267)</option>
            <option value="55">Brazil (55)</option>
            <option value="673">Brunei (673)</option>
            <option value="359">Bulgaria (359)</option>
            <option value="226">Burkina Faso (226)</option>
            <option value="95">Burma (Myanmar) (95)</option>
            <option value="257">Burundi (257)</option>
            <option value="855">Cambodia (855)</option>
            <option value="237">Cameroon (237)</option>
            <option value="1">Canada (1)</option>
            <option value="238">Cape Verde (238)</option>
            <option value="236">Central African Republic (236)</option>
            <option value="235">Chad (235)</option>
            <option value="56">Chile (56)</option>
            <option value="86">China (86)</option>
            <option value="61">Christmas Island (61)</option>
            <option value="61">Cocos (Keeling) Islands (61)</option>
            <option value="57">Colombia (57)</option>
            <option value="269">Comoros (269)</option>
            <option value="243">Congo (243)</option>
            <option value="682">Cook Islands (682)</option>
            <option value="506">Costa Rica (506)</option>
            <option value="385">Croatia (385)</option>
            <option value="53">Cuba (53)</option>
            <option value="357">Cyprus (357)</option>
            <option value="420">Czech Republic (420)</option>
            <option value="45">Denmark (45)</option>
            <option value="253">Djibouti (253)</option>
            <option value="593">Ecuador (593)</option>
            <option value="20">Egypt (20)</option>
            <option value="503">El Salvador (503)</option>
            <option value="240">Equatorial Guinea (240)</option>
            <option value="291">Eritrea (291)</option>
            <option value="372">Estonia (372)</option>
            <option value="251">Ethiopia (251)</option>
            <option value="500">Falkland Islands (500)</option>
            <option value="298">Faroe Islands (298)</option>
            <option value="679">Fiji (679)</option>
            <option value="358">Finland (358)</option>
            <option value="33">France (33)</option>
            <option value="689">French Polynesia (689)</option>
            <option value="241">Gabon (241)</option>
            <option value="220">Gambia (220)</option>
            <option value="970">Gaza Strip (970)</option>
            <option value="995">Georgia (995)</option>
            <option value="49">Germany (49)</option>
            <option value="233">Ghana (233)</option>
            <option value="350">Gibraltar (350)</option>
            <option value="30">Greece (30)</option>
            <option value="299">Greenland (299)</option>
            <option value="502">Guatemala (502)</option>
            <option value="224">Guinea (224)</option>
            <option value="245">Guinea-Bissau (245)</option>
            <option value="592">Guyana (592)</option>
            <option value="509">Haiti (509)</option>
            <option value="39">Holy See (Vatican City) (39)</option>
            <option value="504">Honduras (504)</option>
            <option value="852">Hong Kong (852)</option>
            <option value="36">Hungary (36)</option>
            <option value="354">Iceland (354)</option>
            <option value="91">India (91)</option>
            <option value="62">Indonesia (62)</option>
            <option value="98">Iran (98)</option>
            <option value="964">Iraq (964)</option>
            <option value="353">Ireland (353)</option>
            <option value="44">Isle of Man (44)</option>
            <option value="972">Israel (972)</option>
            <option value="39">Italy (39)</option>
            <option value="225">Ivory Coast (225)</option>
            <option value="81">Japan (81)</option>
            <option value="962">Jordan (962)</option>
            <option value="7">Kazakhstan (7)</option>
            <option value="254">Kenya (254)</option>
            <option value="686">Kiribati (686)</option>
            <option value="381">Kosovo (381)</option>
            <option value="965">Kuwait (965)</option>
            <option value="996">Kyrgyzstan (996)</option>
            <option value="856">Laos (856)</option>
            <option value="371">Latvia (371)</option>
            <option value="961">Lebanon (961)</option>
            <option value="266">Lesotho (266)</option>
            <option value="231">Liberia (231)</option>
            <option value="218">Libya (218)</option>
            <option value="423">Liechtenstein (423)</option>
            <option value="370">Lithuania (370)</option>
            <option value="352">Luxembourg (352)</option>
            <option value="853">Macau (853)</option>
            <option value="389">Macedonia (389)</option>
            <option value="261">Madagascar (261)</option>
            <option value="265">Malawi (265)</option>
            <option value="60">Malaysia (60)</option>
            <option value="960">Maldives (960)</option>
            <option value="223">Mali (223)</option>
            <option value="356">Malta (356)</option>
            <option value="692">Marshall Islands (692)</option>
            <option value="222">Mauritania (222)</option>
            <option value="230">Mauritius (230)</option>
            <option value="262">Mayotte (262)</option>
            <option value="52">Mexico (52)</option>
            <option value="691">Micronesia (691)</option>
            <option value="373">Moldova (373)</option>
            <option value="377">Monaco (377)</option>
            <option value="976">Mongolia (976)</option>
            <option value="382">Montenegro (382)</option>
            <option value="212">Morocco (212)</option>
            <option value="258">Mozambique (258)</option>
            <option value="264">Namibia (264)</option>
            <option value="674">Nauru (674)</option>
            <option value="977">Nepal (977)</option>
            <option value="31">Netherlands (31)</option>
            <option value="599">Netherlands Antilles (599)</option>
            <option value="687">New Caledonia (687)</option>
            <option value="64">New Zealand (64)</option>
            <option value="505">Nicaragua (505)</option>
            <option value="227">Niger (227)</option>
            <option value="234">Nigeria (234)</option>
            <option value="683">Niue (683)</option>
            <option value="672">Norfolk Island (672)</option>
            <option value="850">North Korea (850)</option>
            <option value="47">Norway (47)</option>
            <option value="968">Oman (968)</option>
            <option value="92">Pakistan (92)</option>
            <option value="680">Palau (680)</option>
            <option value="507">Panama (507)</option>
            <option value="675">Papua New Guinea (675)</option>
            <option value="595">Paraguay (595)</option>
            <option value="51">Peru (51)</option>
            <option value="63">Philippines (63)</option>
            <option value="870">Pitcairn Islands (870)</option>
            <option value="48">Poland (48)</option>
            <option value="351">Portugal (351)</option>
            <option value="1">Puerto Rico (1)</option>
            <option value="974">Qatar (974)</option>
            <option value="242">Republic of the Congo (242)</option>
            <option value="40">Romania (40)</option>
            <option value="7">Russia (7)</option>
            <option value="250">Rwanda (250)</option>
            <option value="590">Saint Barthelemy (590)</option>
            <option value="290">Saint Helena (290)</option>
            <option value="508">Saint Pierre and Miquelon (508)</option>
            <option value="685">Samoa (685)</option>
            <option value="378">San Marino (378)</option>
            <option value="239">Sao Tome and Principe (239)</option>
            <option value="966">Saudi Arabia (966)</option>
            <option value="221">Senegal (221)</option>
            <option value="381">Serbia (381)</option>
            <option value="248">Seychelles (248)</option>
            <option value="232">Sierra Leone (232)</option>
            <option value="65">Singapore (65)</option>
            <option value="421">Slovakia (421)</option>
            <option value="386">Slovenia (386)</option>
            <option value="677">Solomon Islands (677)</option>
            <option value="252">Somalia (252)</option>
            <option value="27">South Africa (27)</option>
            <option value="82">South Korea (82)</option>
            <option value="34">Spain (34)</option>
            <option value="94">Sri Lanka (94)</option>
            <option value="249">Sudan (249)</option>
            <option value="597">Suriname (597)</option>
            <option value="268">Swaziland (268)</option>
            <option value="46">Sweden (46)</option>
            <option value="41">Switzerland (41)</option>
            <option value="963">Syria (963)</option>
            <option value="886">Taiwan (886)</option>
            <option value="992">Tajikistan (992)</option>
            <option value="255">Tanzania (255)</option>
            <option value="66">Thailand (66)</option>
            <option value="670">Timor-Leste (670)</option>
            <option value="228">Togo (228)</option>
            <option value="690">Tokelau (690)</option>
            <option value="676">Tonga (676)</option>
            <option value="216">Tunisia (216)</option>
            <option value="90">Turkey (90)</option>
            <option value="993">Turkmenistan (993)</option>
            <option value="688">Tuvalu (688)</option>
            <option value="256">Uganda (256)</option>
            <option value="380">Ukraine (380)</option>
            <option value="971">United Arab Emirates (971)</option>
            <option value="44">United Kingdom (44)</option>
            <option value="1">United States (1)</option>
            <option value="598">Uruguay (598)</option>
            <option value="998">Uzbekistan (998)</option>
            <option value="678">Vanuatu (678)</option>
            <option value="58">Venezuela (58)</option>
            <option value="84">Vietnam (84)</option>
            <option value="681">Wallis and Futuna (681)</option>
            <option value="970">West Bank (970)</option>
            <option value="967">Yemen (967)</option>
            <option value="260">Zambia (260)</option>
            <option value="263">Zimbabwe (263)</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
          <input type="text" class="form-control recibir-wp" placeholder="0000000000" name="numero-wp" pattern="\d*" id="wsp">
        </div>
        <div class="col-md-2">
          <label for="">Fecha <span class="text-success">(*)</span></label>
          <input type="date" class="form-control" required="" name="fecha_reparacion" id="theDate">
        </div>

      </div>

      <div class="row">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Información del equipo
          </div>
        </div>
        <div class="col-md-3 col-12">
          <div class="form-group">
            <label for="tecnico">Técnico Asignado</label>
            <select id="tecnico" class="form-control mySelect2" data-placeholder="Seleccione un técnico(Opcional)" name="tecnico">
              <option value=""></option>
              <?php

              $tecnicos = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();
              foreach ($tecnicos as $key => $value) :
              ?>

                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>

              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-12">
          <div class="form-group">
            <label for="fecha_prometida">Fecha de entrega prometida</label>
            <input id="fecha_prometida" class="form-control theDate" type="date" name="fecha_prometida">


          </div>
        </div>
        <div class="col-md-2 col-12">
          <div class="form-group">
            <label for="hora_prometida">Hora de entrega prometida</label>

            <input id="hora_prometida" class="form-control " type="time" name="hora_prometida">

          </div>
        </div>
        <div class="col-md-3 col-12">
          <div class="form-group">
            <label for="usuario_recibio">Usuario recibio</label>
            <select id="usuario_recibio" class="form-control mySelect2" data-placeholder="Seleccione un vendedor" name="usuario_recibio" required>
              <option value="<?php echo $_SESSION["nombre"] ?>"><?php echo $_SESSION["nombre"] ?></option>
              <?php

              $vendedor = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();
              foreach ($vendedor as $key => $value) :
              ?>

                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>

              <?php endforeach; ?>
            </select>
          </div>
        </div>

      </div>

      <div class="row">






        <div class="col-md-2">
          <strong>Descripción del equipo <span class="text-success">(*)</span></strong><br>
          <label for="">Equipo</label>
          <select id="" class="form-control" name="equipo">
            <option value="Celular">Celular</option>
            <option value="Computadora">Computadora</option>
            <option value="Laptop">Laptop</option>
            <option value="Tablet">Tablet</option>
            <option value="Consola">Consola</option>
            <option value="Otro">Otro</option>


          </select>
        </div>
        <div class="col-md-2">
          <br>
          <label for="">IMEI / Número de Serie</label>
          <input type="text" class="form-control" placeholder="Imei/Serie" name="imei" value="">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Marca <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Marca" name="marca" required="">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Modelo <span class="text-success">(*)</span></label>
          <input type="text" class="form-control" placeholder="Modelo" name="modelo" required="">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Color</label>
          <input type="text" class="form-control" placeholder="Color" name="color">
        </div>
        <div class="col-md-2">
          <br>
          <label for="">Observaciones</label>
          <input type="text" class="form-control" placeholder="Observaciones" name="observaciones">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="text-danger">
            *Seleccione al menos una opcion de estas <span class="text-success">(*)</span>
          </div>
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Encendido"> Encendido
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Apagado"> Apagado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Manipulado"> Manipulado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Mojado"> Mojado
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Roto"> Roto
        </div>
        <div class="col-md-2">
          <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Incompleto"> Incompleto
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <label for="">Descripción del problema <span class="text-success">(*)</span></label>
          <textarea id="" cols="30" rows="5" class="form-control" name="problema" required=""></textarea>
        </div>
        <div class="col-md-6">
          <label for="">Solución (opcional)</label>
          <textarea id="" cols="30" rows="5" class="form-control" name="solucion"></textarea>
        </div>
      </div>
      <div class="row">

        <div class="col-md-6">
          <br>
          <br>
          <p>Pin Númerico</p>
        </div>
        <div class="col-md-6">
          <p>Estetica</p>
        </div>

      </div>

      <div class="row">
        <div class="col-12 col-md-12 text-center">
          <div class="text-danger">
            *Seleccione una opcion de estas <span class="text-success">(*)</span>
          </div>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="" name="desbloqueo">
        </div>

        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Bueno"> Bueno

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Regular"> Regular

        </div>
        <div class="col-md-3">

          <input type="radio" class="" name="estetica" value="Malo"> Malo

        </div>
      </div>
      </br>
      <div class="row">
        <div class="col-md-12 col-12">
          <div class="alert alert-dark" role="alert">
            Presupuesto
          </div>
        </div>
        <div class="col-md-4">
          <label for="">Importe <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat importe" placeholder="$" required="" name="importe">
        </div>
        <div class="col-md-4">
          <label for="">Anticipo <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat anticipo" placeholder="$" required="" value="0" name="anticipo">
        </div>
        <div class="col-md-4">
          <label for="">Total <span class="text-success">(*)</span></label>
          <input type="text" class="form-control efectivoFormat total" placeholder="$" required="" name="total">
        </div>

      </div>
      <br>
      <div class="row">
        <div class="col-md-4 float-right">
          <input type="submit" value="Guardar" class="btn btn-dark btn-block mb-5" name="btnRegistrarServicio">
        </div>
      </div>
      <?php

      $servicios = new ControladorServicios();
      $servicios->ctrRegistrarServicio();
      ?>
    </form>
  </section>
  <!-- /.content -->
<?php }
if (isset($_SESSION['presupuesto'])) {
  $_SESSION['presupuesto'] = "";
}
?>



<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">

          
          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            Campos obligatotios(*)
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><strong>*</strong><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento">

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección">

              </div>

            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="">Código</label>
                <input type="text" class="form-control input-lg" placeholder="52" name="codigo-wp" value="" pattern="\d*" maxlength="2" id="codigo">
              </div>
              <div class="col-md-10">
                <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
                <input type="text" class="form-control input-lg" placeholder="0000000000" name="numero-wp" pattern="\d*" maxlength="10" id="wsp">
              </div>
            </div>
            <br>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Guardar cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente("servicios");

      ?>

    </div>

  </div>

</div>