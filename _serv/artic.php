                                    <ul class="menu">
                                        <li id="artlist" class="active">Lista Articulos</li>
                                        <li id="newartic" class="<?php echo $vurol;?>">Nuevo</li>
                                    </ul>
                                    <span class="clear"></span>
                                        <div class="row content artlist">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Lista Articulos
                                                            <div style="float:right; position:unset">
                                                                    <span id="vcateg" style="margin-right:20px;"><select name="qcateg" id="qcateg" class ="select2" style="width:200px" onchange="selcateg(this.value)"><option value="0">Categorias</option></select></span>
                                                                    <span id="vsubcat" style="margin-right:20px;"><select name="qsubcat" id="qsubcat" class ="select2" style="width:200px" onchange="selsubcateg(this.value)"><option value="0">Sub-Categorias</option></select></span>
                                                            </div>
                                                            <div style="float:right; position:unset;width: 170px;padding-right: 40px;">

                                                                <div id="uploadxls" class="skusel" style="display: block; padding: 2%; max-width: 65px;float: left;">
                                                                    <div style="height:0px; overflow:hidden;">
                                                                    </div>
                                                                    <button style="padding: 3px;" type="button" id="btnroster_0" class="btn btn-primary"  onclick="genlistartxls()"><i class="fa fa-download"></i> XLS </button>
                                                                    <br>
                                                                    <span id="runTimeRosterPreview_0" class="runRosterTimePreview"></span>
                                                                </div>

                                                                <div id="uploadxls" class="skusel" style="display: block; padding: 2%; max-width: 65px;float: right;">
                                                                    <div style="height:0px; overflow:hidden;">
                                                                        <input type="file" id="upload_xls" name="upload_xls[]">
                                                                        <input type="hidden" name="roster_file_path_0" id="roster_file_path_0" value="">
                                                                        
                                                                    </div>
                                                                    <button style="padding: 3px;" type="button" id="btnroster_0" class="btn btn-primary" onclick="callUploadxls();"><i class="fa fa-upload"></i> Actualizar </button>
                                                                    <br>
                                                                    <span id="runTimeRosterPreview_0" class="runRosterTimePreview"></span>
                                                                </div>

                                                            </div>
                                                    </div>
                                                    <div id="divartic" class="panel-body <?php echo $tabadm;?>">
                                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-artic">
                                                            <thead>
                                                                <tr>
                                                                    <th>Codigo</th>
                                                                    <th>Denominacion</th>
                                                                    <th>Categoria</th>
                                                                    <th>Sub Categoria</th>
                                                                    <th>Stock</th>
                                                                    <th>Stock Min</th>
                                                                    <th>Un. Med.</th>
                                                                    <th>Precio</th>
                                                                    <th>Opcion</th>
                                                                    <th>categ_id</th>
                                                                    <th>sc_id</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  content newartic" style="display: none;">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div  id="arthead" class="panel-heading" style="display:table;margin:0 auto;width: 100%;">
                                                        Art&iacute;culo Nuevo
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                                                <tr>
                                                                    <td>
                                                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                                              <tr>
                                                                                <td width="20%"></td>
                                                                                <td width="70%"></td>
                                                                                <td width="10%"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"><b>Denominacion:</b></td>
                                                                                <td colspan=2>
                                                                                    <input class="form-control typeahead" style="width:800px;max-width:800px;" name="vdescrartic" id="vdescrartic" type="text" size="100" >
                                                                                    <input name="vcodartid" id="vcodartid" value="0" type="hidden">
                                                                                    </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"></td>
                                                                                <td id="cattd">
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-3 form-group">
                                                                                        <label> . </label>
                                                                                       <span id="vicateg" style="margin-right:20px;"><select name="icateg" id="icateg" class ="select2" style="width:200px" onchange="selicateg(this.value)"><option value="0">Categorias</option></select></span>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group">
                                                                                        <label> . </label>
                                                                                       <span id="visubcat" style="margin-right:20px;"><select name="isubcat" id="isubcat" class ="select2" style="width:200px"><option value="0">Sub-Categorias</option></select></span>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group">
                                                                                        <label>Codigo Proveedor</label>
                                                                                        <input class="form-control" id="vcodprov" placeholder="" value="" type="number" name="quantity" min="1" max="999999999999999" step="1" maxlength="15">
                                                                                        <!-- <input class="form-control" id="vcodprov" placeholder="" value="" readonly="readonly"> -->
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"></td>
                                                                                <td>
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Stock Min.</label>
                                                                                        <input class="form-control" id="vstockmin" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Stock actual</label>
                                                                                        <input class="form-control" id="vstockart" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Consumo Prom.</label>
                                                                                        <input class="form-control" id="vconsavg" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Consumo Capt.</label>
                                                                                        <input class="form-control" id="iconscapt" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"></td>
                                                                                <td>
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Unidad compra</label>
                                                                                        <span id="viunidcpra" style="margin-right:20px;"><select name="iunidcpra" id="iunidcpra" class ="select2" style="width:130px"><option value="0">Seleccione</option></select></span>
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Unidad Equiv.</label>
                                                                                        <input class="form-control" id="iunideq" placeholder="" value="1">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Unidad stock</label>
                                                                                        <span id="vistkunid" style="margin-right:20px;"><select name="istkunid" id="istkunid" class ="select2" style="width:130px"><option value="0">Seleccione</option></select></span>
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"></td>
                                                                                <td>
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Dias Recupero</label>
                                                                                        <input class="form-control" id="vdiasrecu" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Recup. margen</label>
                                                                                        <input class="form-control" id="vrecumarg" placeholder="" value="0" readonly="readonly">
                                                                                    </div>
                                                                                    <div class="col-lg-2 form-group">
                                                                                        <label>Precio venta</label>
                                                                                        <input class="form-control" id="iprecart" placeholder="" value="0">
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;"></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td colspan=3 style="border-bottom:1px solid #000"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td colspan=3 id="artictdsave">
                                                                                                <button id="saveartic" class="btn btn-primary" type="button" onclick="savenewart()"><i class="fa fa-plus"></i> Guardar</button>
                                                                                </td>
                                                                              </tr>
                                                                            </table>
                                                                    </td>
                                                                </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
