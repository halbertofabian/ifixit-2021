<div class="jumbotron">
    <h3 class="display-4">Bienvenido al módulo mi web</h3>
    <p class="lead"></p>
    <hr class="my-4">
    <p>Tiene como objetivo dar a conocer los servicios que ofrece tu empresa, ademas de que así lo requieras muestra los productos de tu inventario. Por último para estos tiempos de contingencia, habilitamos un módulo para que tus clientes soliciten el servicio a domicilio.</p>
    <!-- <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="fas fa-cog"></i> Configurar mi web
    </a> -->
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <label class="custom-control-label" for="customSwitch1">Activar mi página web</label>
    </div>
</div>

<div class="container-fluid">

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="container">
                <form action="" method="post">
                    <fieldset disabled>
                        <div class="row">
                            <div class="form-group col-12 col-md-3">
                                <label for="my-input">Nombre de la sucursal</label>
                                <input id="my-input" class="form-control" type="text" readonly name="">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="my-input">Token de sincronización</label>
                                <input id="my-input" class="form-control" type="text" readonly name="">
                            </div>
                            <div class="form-group col-12 col-md-5">
                                <label for="my-input">Liga de mi web</label>
                                <input id="my-input" class="form-control" type="text" placeholder="" readonly name="">
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="">Comparte tu web</label>
                                <br>
                                <div class="btn-group" role="group" aria-label="Button group">
                                    <button class="btn btn-primary"><i class="fas fa-copy"></i></button>
                                    <button class="btn btn-primary"> <i class="fas fa-share"></i></button>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
                <div class="form-ativeConf mt-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active text-dark" aria-current="page">Información de la sucursal</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my-input">Número de atención a clientes</label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my-input">Correo de atención a clientes <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Te gustaría tener un correo corporativo <?php echo strtolower($_SESSION['nombre']) ?>@<?php echo strtolower(str_replace('-', ' ', trim($_SESSION['nom_suc']))) ?>.com Ponte en contacto con nosostros."></i></label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my-input">Whatsapp de atención a clientes <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Te gustaría tener un correo corporativo <?php echo strtolower($_SESSION['nombre']) ?>@<?php echo strtolower(str_replace('-', ' ', trim($_SESSION['nom_suc']))) ?>.com Ponte en contacto con nosostros."></i></label>
                                    <select name="" class="form-control mySelect2">
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my-input">Número de WhatsApp</label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Dirección de la sucursal</label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Horario de atención</label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Sitio web</label>
                                    <input id="my-input" class="form-control" type="text" name="">
                                </div>
                            </div>
                            <div class="col-12">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active text-dark" aria-current="page">Redes sociales</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Facebook</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://facebook.com/</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" placeholder="user" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Twitter</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://twitter.com/</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" placeholder="user" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Instagram</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://www.instagram.com/</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" placeholder="user" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Youtube</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://www.youtube.com/channel/</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" placeholder="user" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <button class="btn btn-primary float-right " type="submit">Guardar Cambios</button>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 




</div>