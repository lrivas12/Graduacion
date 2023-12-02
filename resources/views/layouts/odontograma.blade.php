@extends('layouts.index')

@section('css')
@section('css')
    <style>
        .section {
            display: flex;
            justify-content: space-between;
        }

        .fa-question-circle {
            font-size: 27px;
        }

        .table {
            padding: 5%;
        }

        .odontoimg {
            max-width: 55px;
            max-height: 80px;
        }

        .odontoimg2 {
            max-width: 30px;
            max-height: 50px;
        }

        .table input {
            transition: all .1s ease-in-out;
            vertical-align: top;
        }

        .table input:hover {

            transform: scale(1.2);
        }

        .table tr:nth-child(odd) td {
            background-color: transparent;
        }

        .table tr:hover td {
            background-color: transparent;
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        img.hover {
            background: transparent;
            border: 1px dashed #0066cc;
            padding-left: 4px;
            padding-right: 5px;
        }

        address {
            margin-bottom: 3px;
        }

        th .text-center {
            align-items: center;
            margin-right: 80px
        }
        .clinica {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            /* Centra el contenido horizontalmente */
            display: flex;
            align-items: center;
            /* Centra el contenido verticalmente */
            flex-direction: column;
            /* Alinea los elementos verticalmente */
        }
        .logo {
            /* Alinea el div "logo" a la derecha */
            max-width: 200px;
            max-height: 200px;
        }
    </style>
@stop


@section('content')
   <div class="card">
        <div class="card-body">
                <div class="row">
                        <div class="col ">
                            <form>
                            <div class="row ">
                            <div class="col-sm-8">
                                    <div class="form-label"><b>Datos Clínica</b></div>
                                    <address contenteditable id="contacto">Nombre Clínica*</address> 
                                    <address contenteditable >Nombre Odontólogo</address> 
                                    <address contenteditable id="telefono">Teléfono*</address> 
                                    <address contenteditable id="correo">Correo*</address> 
                                    <address contenteditable >Dirección</address> 
                                    <address contenteditable >N.I.F.</address> 
                            
                            </div>
                            </div>	
                            </form>
                </div>
                             
                <div class="col ">
                  
                            <form>
                            <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                    <div class="form-label"><b>Datos Cliente</b></div>
                                    <address contenteditable >Nombre Cliente</address> 
                                    <address contenteditable >Teléfono</address> 
                                    <address contenteditable >Correo</address> 
                                    <address contenteditable >Dirección</address> 
                                    <address contenteditable >Edad</address> 
                                    <address contenteditable >Género</address> 
                                    
                            
                </div>
                </div>
                    </form>
                    </div>
                    </div>	  
                              
            <table class="table table-responsive" style="margin-top:25px;">

                <tr class="filaup">
                            <td><input type="image" src="https://odontograma.net/images/dientes/18C.png" id="18c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/17C.png" id="17c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/16C.png" id="16c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/15C.png" id="15c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/14C.png" id="14c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/13C.png" id="13c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                              <td><input type="image" src="https://odontograma.net/images/dientes/12C.png" id="12c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                          <td><input type="image" src="https://odontograma.net/images/dientes/11C.png" id="11c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/21C.png" id="21c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/22C.png" id="22c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/23C.png" id="23c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/24C.png" id="24c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/25C.png" id="25c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/26C.png" id="26c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/27C.png" id="27c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/28C.png" id="28c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
                    <tr class="filaup">
                            <td><input type="image" src="https://odontograma.net/images/dientes/18B.png" id="18b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/17B.png" id="17b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/16B.png" id="16b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/15B.png" id="15b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/14B.png" id="14b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td></td>
                              <td></td>
                          <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/24B.png" id="24b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/25B.png" id="25b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/26B.png" id="26b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/27B.png" id="27b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/28B.png" id="28b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
                    <tr>
                            <td><input type="image" src="https://odontograma.net/images/dientes/18A.png" id="18a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/17A.png" id="17a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/16A.png" id="16a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/15A.png" id="15a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/14A.png" id="14a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/13A.png" id="13a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                              <td><input type="image" src="https://odontograma.net/images/dientes/12A.png" id="12a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                          <td><input type="image" src="https://odontograma.net/images/dientes/11A.png" id="11a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/21A.png" id="21a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/22A.png" id="22a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/23A.png" id="23a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/24A.png" id="24a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/25A.png" id="25a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/26A.png" id="26a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/27A.png" id="27a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/28A.png" id="28a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
                    <tr>
                            <td>18</td>
                            <td>17</td>
                            <td>16</td>
                            <td>15</td>
                            <td>14</td>
                            <td>13</td>
                              <td>12</td>
                          <td>11</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                </tr>
                    <tr>
                            <td>48</td>
                            <td>47</td>
                            <td>46</td>
                            <td>45</td>
                            <td>44</td>
                            <td>43</td>
                              <td>42</td>
                          <td>41</td>
                            <td>31</td>
                            <td>32</td>
                            <td>33</td>
                            <td>34</td>
                            <td>35</td>
                            <td>36</td>
                            <td>37</td>
                            <td>38</td>
                </tr>
                    <tr class="abajo">
                            <td><input type="image" src="https://odontograma.net/images/dientes/48A.png" id="48a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/47A.png" id="47a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/46A.png" id="46a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/45A.png" id="45a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/44A.png" id="44a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/43A.png" id="43a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                              <td><input type="image" src="https://odontograma.net/images/dientes/42A.png" id="42a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                          <td><input type="image" src="https://odontograma.net/images/dientes/41A.png" id="41a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/31A.png" id="31a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/32A.png" id="32a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/33A.png" id="33a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/34A.png" id="34a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/35A.png" id="35a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/36A.png" id="36a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/37A.png" id="37a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/38A.png" id="38a" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
                    <tr class="filadown">
                            <td><input type="image" src="https://odontograma.net/images/dientes/48B.png" id="48b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/47B.png" id="47b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/46B.png" id="46b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/45B.png" id="45b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/44B.png" id="44b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td></td>
                              <td></td>
                          <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/34B.png" id="34b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/35B.png" id="35b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/36B.png" id="36b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/37B.png" id="37b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/38B.png" id="38b" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
                    <tr class="filadown">
                            <td><input type="image" src="https://odontograma.net/images/dientes/48C.png" id="48c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/47C.png" id="47c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/46C.png" id="46c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/45C.png" id="45c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/44C.png" id="44c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/43C.png" id="43c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                              <td><input type="image" src="https://odontograma.net/images/dientes/42C.png" id="42c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                          <td><input type="image" src="https://odontograma.net/images/dientes/41C.png" id="41c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/31C.png" id="31c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/32C.png" id="32c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/33C.png" id="33c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/34C.png" id="34c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/35C.png" id="35c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/36C.png" id="36c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/37C.png" id="37c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                            <td><input type="image" src="https://odontograma.net/images/dientes/38C.png" id="38c" data-bs-toggle="modal" data-bs-target="#modalpieza" alt="odontograma"></td>
                </tr>
            </table>
                            
                              
                              
                    
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Tratamiento</th>
                  <th scope="col">Pieza</th>
                  <th scope="col">Cara</th>
                            <th scope="col"></th>
                </tr>
              </thead>
              <tbody id="tabla">
              </tbody>
             </table>
                              
                    
              <form class="container-fluid justify-content-start" style="margin-top:15px;margin-bottom:15px;padding-left:0px;">
               <button type="button" class="btn btn-primary hide-print" data-bs-toggle="modal" data-bs-target="#modalpieza" style="margin:0px;"><img decoding="async" src="https://odontograma.net/images/plus-circle.svg" width="15px" height="15px" > Añadir tratamiento</button>
              </form>
            
                              
                     <div class="row">
                                      <div class="col hide-print" id="#hideprivacidad">
                     <input type="checkbox" name="privacidad3" id="privacidad" class="privacidad" required="required" value="Aceptar" /> He leído y acepto el <a href="https://www.mnprogram.com/aviso-legal" class="enlace" target="_blank">aviso legal</a> y recibir comunicaciones.
                                              </div>
                      </div>  
             </div>
                    
                      
             
                      
                      
                      
                      
            
            <div class="modal fade" id="modalpieza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Tratamiento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                            
                  <div class="modal-body">
                              
                              <div class="mb-3">
                                      <label for="exampleFormControlInput3" class="form-label">Selecciona Pieza:</label><br>
                                      <select class="form-select form-control" aria-label="Selecciona Pieza" id="selpieza" name="selpieza" >
                                              <option selected value="00">Todas</option>
                                              <option value="11">11</option>
                                               <option value="12">12</option>
                                              <option  value="13">13</option>
                                              <option  value="14">14</option>
                                              <option  value="15">15</option>
                                              <option  value="16">16</option>
                                              <option  value="17">17</option>
                                              <option  value="18">18</option>
                                              <option  value="21">21</option>
                                              <option  value="22">22</option>
                                              <option  value="23">23</option>
                                              <option  value="24">24</option>
                                              <option  value="25">25</option>
                                              <option  value="26">26</option>
                                              <option  value="27">27</option>
                                              <option  value="28">28</option>
                                              <option  value="31">31</option>
                                              <option  value="32">32</option>
                                              <option  value="33">33</option>
                                              <option  value="34">34</option>
                                              <option  value="35">35</option>
                                              <option  value="36">36</option>
                                              <option  value="37">37</option>
                                              <option  value="38">38</option>
                                              <option  value="41">41</option>
                                              <option  value="42">42</option>
                                              <option  value="43">43</option>
                                              <option  value="44">44</option>
                                              <option  value="45">45</option>
                                              <option  value="46">46</option>
                                              <option  value="47">47</option>
                                              <option  value="48">48</option>
                                              
                                      </select>
                              </div>
                              
                              
                              <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Selecciona Tratamiento:</label><br>
                              <select class="form-select form-control" aria-label="Selecciona tratamiento" id="seltratamiento" name="seltratamiento" >
                       <option selected value="icono-apiceptomias.png">Apiceptomía</option>
                                <option value="icono-carillas.png">Carillas</option>
                                 <option value="icono-cirugia.png">Cirugía</option>
                                 <option value="icono-contacto-alimento.png">Contanto Alimento</option>
                               <option value="icono-coronas.png">Cororona</option>
                               <option value="icono-curetajes.png">Curetaje</option>
                               <option value="icono-endodoncias.png">Endodoncia</option>
                               <option value="icono-esqueletico.png">Esquelético</option>
                               <option value="icono-estetica.png">Estética</option>
                               <option value="icono-exploración.png">Exploración</option>
                               <option value="icono-extrusion.png">Extrusión</option>
                               <option value="icono-furcas.png">Furcas</option>
                               <option value="icono-girar.png">Girar</option>
                               <option value="icono-impacto-alimento.png">Impacto Alimento</option>
                               <option value="icono-impresiones-estudio.png">Impresiones</option>
                               <option value="icono-inclinación.png">Inclinación</option>
                               <option value="icono-limpieza.png">Limpieza</option>
                               <option value="icono-movilidad.png">Movilidad</option>
                               <option value="icono-obturacion.png">Obturación</option>
                               <option value="icono-ortodoncia.png">Ortodoncia</option>
                               <option value="icono-perno.png">Perno</option>
                               <option value="icono-pilar-solo.png">Pilar Solo</option>
                               <option value="icono-pilar-transepitelial.png">Pilar Transpitelial</option>
                               <option value="icono-placa-descarga.png">Placa Descarga</option>
                               <option value="icono-protesis-removible.png">Protesis Removible</option>
                               <option value="icono-puente.png">Puente</option>
                               <option value="icono-quitar.png">Quitar</option>
                               <option value="icono-radiografia.png">Radiografía</option>
                               <option value="icono-reconstrucción.png">Reconstrucción</option>
                               <option value="icono-sangrado.png">Sangrado</option>
                               <option value="icono-sellador.png">Sellador</option>
                               <option value="icono-sensibilidad.png">Sensibilidad</option>
                               <option value="icono-supurado.png">Supurado</option>
                               <option value="icono-tornillo.png">Tornillo</option>
                               <option value="icono-tornillo-solo.png">Tornillo Solo</option>
                               <option value="icono-tratamiento.png">Tratamiento</option>
                               </select>
                              </div>
                              <div class="">
                                      
                                       <label for="exampleFormControlInput2" class="form-label">Selecciona Cara:</label><br>
                                 <select class="form-select form-control" aria-label="Selecciona cara" id="selcara" name="selcara" >
                                              <option selected value="Vestibular">Vestibular</option>
                                              <option value="Lingual">Lingual</option>
                                              <option value="Palatino">Palatino</option>
                                              <option value="Mesial">Mesial</option>
                                               <option value="Distal">Distal</option>
                                              <option value="Oclusal">Oclusal</option>
                                    </select>
                              </div>
                              
                  </div>
                  <div class="modal-footer">
                   
                    <button type="button" class="btn btn-primary" id="btn-tratamiento"   data-bs-dismiss="modal" aria-label="Close">Añadir </button>
                  </div>  
                </div>
        </div>   
</div>
</div>

<br>
        <div class="float-right">
                <button id="imprimirBtn" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                    {{ __(' Guardar') }}
                </button>
                <script>
                    document.getElementById('imprimirBtn').addEventListener('click', function() {
                        window.print();
                    });
                </script>
              </div>
              <br>
       </div>  
@endsection

@section('js')

<script>
var npieza = "0"
	 var npieza2 = "0"
	 
	 $( ".table input" ).click(function() {
  				npieza = $(this)[0].id;
				npieza2 = npieza.substring(0, npieza.length - 1);
		        $( "#selpieza" ).val(npieza2);
	 });
		
	 $( "#btn-tratamiento" ).click(function() {
			var seltratamiento = $('#seltratamiento').val();
			var texttratamiento = $('select[name="seltratamiento"] option:selected').text();
			var selcara = $('#selcara').val();
		    var spieza = $('#selpieza').val();
		
		 

			$('#'+npieza).parent().append('<div><img decoding="async" src="https://odontograma.net/images/tratamientos/'+seltratamiento+'" width="20px" height="20px" class="imgtratamient"></div>');
			$('#tabla').append('<tr class="'+npieza+'"><th scope="row"><img decoding="async" src="https://odontograma.net/images/tratamientos/'+seltratamiento+'" width="25px" height="25px"> '+texttratamiento+'</th><td>'+npieza+'</td><td>'+selcara+'</td><td><a href="" class="delete"  width="25px" height="25px" type="button"><img decoding="async" src="https://odontograma.net/images/trash3.svg" width="20px" height="auto"></a></td></tr>');
			$( '#'+npieza).parent().css('background-color','#bee3ce');
	 });	
		
	 $(document).on('click', '.delete', function () {
      
		var piezaclass = $(this).closest('tr').attr('class');
	   $('#'+piezaclass).siblings().remove();
		$( '#'+piezaclass).parent().css('background-color','#fff');
		 
		 
		 
		$(this).closest('tr').remove();
		 
      return false;
   	 });	
		
		
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>		  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  
@endsection