<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-5">Nuevo servicio</h3>
    <p class="lead">Este módulo de creación de servicio es nuevo, pensado en las necesidades de nuestros clientes, se pensó mejorar la experiencia de usuario.</p>

    <?php
    $clientes = ControladorClientes::ctrMostrarClientes(null, null); ?>
    <select id="mySelect2" class="mySelect2" style="height: 50px; " data-placeholder="Seleccione un cliente(Opcional)" >
      <option value=""></option>
      <?php foreach ($clientes as $key => $value) : ?>
        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] . " " . $value['telefono'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="container mb-5">
  <div class="alert alert-dark" role="alert">
    <strong>Información del cliente</strong>
  </div>

  <div class="row row-cliente">
    <div class="col-12 col-md-4">
      <div class="form-group">
        <label for="my-input">Identificador</label>
        <input id="my-input" class="form-control" type="text" placeholder="Identificador" name="">
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" required="" id="nombre">

      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="form-group">
        <label for="contacto">Teléfono</label>
        <input type="text" class="form-control mandarWP" name="contacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask id="contacto">
        <button type="button" class="btn btn-primary float-right mt-1" id="pasarWP">

          <i class="fas fa-copy"></i>

        </button>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="text" class="form-control" placeholder="Correo" name="email" id="email">
      </div>
    </div>

    <div class="col-12 col-md-2">
      <div class="form-group">
        <label for="codigo">Código (Lada país)</label>
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
        <a href="#" class="float-right">Guardar selección</a>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <div class="form-group">
        <label for="my-input">WhatsApp</label>
        <input type="text" class="form-control recibir-wp" placeholder="0000000000" name="numero-wp" pattern="\d*" id="wsp">
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-dark float-right">Guardar cliente</button>
    </div>

  </div>

  <div class="alert alert-dark mt-4" role="alert">
    <strong>Información del equipo</strong>
  </div>

  <div class="row row-equipo">
    <div class="col-md-4 col-12">
      <div class="form-group">
        <label for="my-input">Técnico asociado a esta reparación</label>
        <input id="my-input" class="form-control" type="text" name="">
        <a href="" class="float-right">Agregar uno nuevo</a>
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Fecha de recepción</label>
        <input id="my-input" class="form-control" type="date" name="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Fecha de entrega</label>
        <input id="my-input" class="form-control" type="date" name="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Hora de entrega</label>
        <input id="my-input" class="form-control" type="time" name="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">El usuario que reibe es:</label>
        <select name="" id="" class="form-control"></select>
      </div>
    </div>
    <div class=" col-12 alert alert-light mt-4" role="alert">
      <strong>Descripción del equipo</strong>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Tipo de equipo</label>
        <select name="" class="form-control" id=""></select>
        <a href="" class="float-right">Agregar otro tipo de equipo</a>
      </div>
    </div>
    <div class="col-md-4 col-12">
      <div class="form-group">
        <label for="my-input">IMEI / Nº SERIE </label>
        <input type="text" class="form-control" name="" id="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Marca </label>
        <input type="text" class="form-control" name="" id="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Modelo </label>
        <input type="text" class="form-control" name="" id="">
      </div>
    </div>
    <div class="col-md-2 col-12">
      <div class="form-group">
        <label for="my-input">Color </label>
        <input type="text" class="form-control" name="" id="">
      </div>
    </div>
    <div class="col-md-4 col-12">
      <div class="form-group">
        <label for="my-input">Agrega tus observaciones </label>
        <input type="text" class="form-control" data-role="tagsinput" name="" placeholder="Ej. Deja chip, no trae batería, etc." id="">
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="text-center">
        <strong>*Seleccione al menos una opción de estas (*)</strong>
        <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-1" value="Encendido">
          <label class="form-check-label" for="opc-e-1">Encendido</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-2" value="Apagado">
          <label class="form-check-label" for="opc-e-2">Apagado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-3" value="Manipulado">
          <label class="form-check-label" for="opc-e-3">Manipulado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-4" value="Mojado">
          <label class="form-check-label" for="opc-e-4">Mojado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-5" value="Roto">
          <label class="form-check-label" for="opc-e-5">Roto</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="opc-e-6" value="Incompleto">
          <label class="form-check-label" for="opc-e-6">Incompleto</label>
        </div>

      </div>
    </div>

    <div class="col-md-6 col-12">
      <label for="">Descripción del problema</label>
      <textarea name="" class="form-control" id="" rows="4"></textarea>
    </div>
    <div class="col-md-6 col-12">
      <label for="">Solución del problema</label>
      <textarea name="" class="form-control" id="" rows="4"></textarea>
    </div>

    <div class="col-md-4 col-12">
      <div class="form-group">
        <label for="my-input">Pin de desbloqueo</label>
        <input id="my-input" class="form-control" type="" name="">
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="text-center">
        <strong>*Seleccione una opción de estas (*)</strong>
        <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="opc-c-1" name="opc-calidad" value="Bueno">
          <label class="form-check-label" for="opc-c-1">Bueno</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="opc-c-2" name="opc-calidad" value="Regular">
          <label class="form-check-label" for="opc-c-2">Regular</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="opc-c-3" name="opc-calidad" value="Malo">
          <label class="form-check-label" for="opc-c-3">Malo</label>
        </div>
      </div>

    </div>




  </div>

  <div class="alert alert-dark mt-4" role="alert">
    <strong>Presupuesto</strong>
  </div>
  <div class="row row-presupuesto mb-5">
    <div class="col-md-4 col-12">
      <div class="form-group">
        <label for="my-input"> Costo de la cotización </label>
        <input id="my-input" class="form-control efectivoFormat" type="text" name="">
      </div>
    </div>
    <div class="col-md-8">
      <button class="btn btn-primary float-right">Calclular presupuesto</button>
    </div>
    <div class="col-md-4 col-12">
      <label for="">Importe <span class="text-success">(*)</span></label>
      <input type="text" class="form-control efectivoFormat importe" placeholder="$" required="" name="importe" value="">
    </div>
    <div class="col-md-4 col-12">
      <label for="">Anticipo <span class="text-success">(*)</span></label>
      <input type="text" class="form-control efectivoFormat anticipo" placeholder="$" required="" value="0" name="anticipo">
    </div>
    <div class="col-md-4 col-12">
      <label for="">Total <span class="text-success">(*)</span></label>
      <input type="text" class="form-control efectivoFormat total" placeholder="$" required="" name="total" value="">
    </div>

  </div>



</div>