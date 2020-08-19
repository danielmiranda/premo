                                    <ul class="menu">
                                        <li id="provlist" class="active">Lista Proveedores</li>
                                        <li id="newproveed" class="<?php echo $vurol;?>">Nuevo</li>
                                    </ul>
                                    <span class="clear"></span>
                                        <div class="row content provlist">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Lista Proveedores
                                                    </div>
                                                    <div id="divproveed" class="panel-body <?php echo $tabadm;?>">
                                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-proveed">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Denominacion</th>
                                                                    <th>Cuit</th>
                                                                    <th>Cond. IVA</th>
                                                                    <th>Opcion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  content newproveed" style="display: none;">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div  id="provhead" class="panel-heading" style="display:table;margin:0 auto;width: 100%;">
                                                        Proveedor Nuevo
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
                                                                                <td >
                                                                                    <input class="form-control typeahead" style="width:800px;max-width:800px;" name="vnombreprov" id="vnombreprov" type="text" size="100" >
                                                                                    <input name="vprovid" id="vprovid" value="0" type="hidden">
                                                                                    </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"><b>CUIT:</b></td>
                                                                                <td >
                                                                                    <span id="vicuit" style="margin-right:20px;position: relative;float: left;"><input class="form-control typeahead" style="width:800px;max-width:200px;" name="vcuitprov" id="vcuitprov" type="text" size="50" ></span>
                                                                                    <span id="vicond" style="margin-right:20px;position: relative;float: left;"><select name="vcondiva" id="vcondiva" class ="select2" style="width:300px;font-size:14px;"><option value="0">CONDICION IVA</option></select></span>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px">Domicilio</td>
                                                                                <td>
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-6 form-group">
                                                                                        <label>Calle</label>
                                                                                        <input class="form-control" id="vdomcalle" placeholder="Calle nro piso dpto"  style="width:600px;max-width:600px;" value="">
                                                                                        <input name="vdomid" id="vdomid" value="0" type="hidden">
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"></td>
                                                                                <td>
                                                                                  <div class="col-lg-12">
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <label>Localidad</label>
                                                                                        <span id="viloc" style="margin-right:10px;position: relative;float: left;"><select name="vlocid" id="vlocid" class ="select2" style="width:250px;font-size:14px;"><option value="0">Localidad</option></select></span>
                                                                                        <span id="vaddloc" style="margin-right:10px;position: relative;float: left;"><a href="javascript:void(0);" onclick="addloc();" title="Agregar Localidad"><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:14px;color:#008000"></i></a></span>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <label>Provincia / Estado</label>
                                                                                        <span id="viprov" style="margin-right:10px;position: relative;float: left;"><input class="form-control" id="vnomprov" placeholder="" value="" readonly="readonly"></span>
                                                                                        <span id="vaddprov" style="margin-right:10px;position: relative;float: left;"><a href="javascript:void(0);" onclick="addprov();" title="Agregar Provincia"><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:14px;color:#008000"></i></a></span>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <label style="width: 100px;">Pais</label>
                                                                                        <span id="vipais" style="margin-right:10px;position: relative;float: left;"><input class="form-control" id="vnompais" placeholder="" value="" readonly="readonly"></span>
                                                                                        <span id="vaddpais" style="margin-right:10px;position: relative;float: left;"><a href="javascript:void(0);" onclick="addpais();" title="Agregar Pais"><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:14px;color:#008000"></i></a></span>
                                                                                    </div>
                                                                                  </div>
                                                                                </td>
                                                                                <td align="center" style="vertical-align:middle;font-size:14px" id="ctddel"></td>
                                                                              </tr>

                                                                              <tr>
                                                                                <td colspan=3 style="border-bottom:1px solid #000; text-align: center; font-size: 15px; font-weight: bold;"><span style="float:left;"><a href="javascript:void(0)" id="addcontit" onclick="addscontitem()"><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:20px;"></i> - Agregar </a></span><span>Detalle de Contactos</span></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td colspan=3>
                                                                                  <table width="50%" id="contTbl" class="table table-striped table-hover">
                                                                                    <thead>
                                                                                      <tr>
                                                                                        <th width="10%"></th>
                                                                                        <th width="20%" style="font-size:16px;">Tipo</th>
                                                                                        <th width="60%" style="font-size:16px;">Contacto</th>
                                                                                        <th width="10%"></th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tfoot>
                                                                                      <tr>
                                                                                        <td width="10%"></td>
                                                                                        <td></td>
                                                                                        <td width="20%"></td>
                                                                                        <td width="10%"></td>
                                                                                      </tr>
                                                                                    </tfoot>
                                                                                    <tbody id="contbdy">
                                                                                    </tbody>
                                                                                  </table>
                                                                                </td>
                                                                              </tr>

                                                                              <tr>
                                                                                <td colspan=3 style="border-bottom:1px solid #000"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td colspan=3 id="provtdsave">
                                                                                                <button id="saveprov" class="btn btn-primary" type="button" onclick="savenewprov()"><i class="fa fa-plus"></i> Guardar</button>
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
