                                    <ul class="menu">
                                        <li id="categlist" class="active">Lista Categorias</li>
                                        <li id="newcateg" class="<?php echo $vurol;?>">Nueva</li>
                                    </ul>
                                    <span class="clear"></span>
                                        <div class="row content categlist">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Lista Categorias
                                                        <div id="dataTables-allorders_processing" class="dataTables_processing divproc" style="z-index: 10; position: fixed; display: none;">Processing...</div>
                                                            <div id="divwo" style="display: none; position: relative; float: none; width: 300px; margin-left: 500px;">
                                                                    Select all <input class="wochkall" name="wochkall" id="wochkall" value="wochkall" onclick="chkwoall(this)" type="checkbox"> <button onclick="generatewo();"><span>Generate WO</span></button>
                                                                  <div class="container col-lg-1" style="float: none; display: inline-block; margin-bottom: -10px;"><div class="row col-lg-1"><div class="col-lg-1"><div class="button-group">
                                                                     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" id="uldr">
                                                                            <?php echo $vdata;?>
                                                                            </ul>
                                                                  </div></div></div>
                                                                  </div>								
                                                            </div>
                                                            <div style="float:right; position:unset">
                                                            </div>
                                                    </div>
                                                    <div id="divcateg" class="panel-body <?php echo $tabadm;?>">
                                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-catego">
                                                            <thead>
                                                                <tr>
                                                                    <th>Categoria</th>
                                                                    <th>Subcategoria</th>
                                                                    <th>Options</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  content newcateg" style="display: none;">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div  id="cathead" class="panel-heading" style="display:table;margin:0 auto;width: 100%;">
                                                        Categoria Nueva
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                                                <tr>
                                                                    <td>
                                                                            <table width="50%" class="table table-striped table-bordered table-hover">
                                                                              <tr>
                                                                                <td width="20%"></td>
                                                                                <td width="70%"></td>
                                                                                <td width="10%"></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td style="text-align:right;vertical-align:middle;font-size:14px"><b>Nombre:</b></td>
                                                                                <td>
                                                                                    <input class="form-control typeahead" style="max-width:500px;" name="categnom" id="categnom" type="text" size="100" >
                                                                                    <input name="categid" id="categid" value="0" type="hidden">
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
                                                                                <td colspan=3 style="border-bottom:1px solid #000; text-align: center; font-size: 15px; font-weight: bold;"><span style="float:left;"><a href="javascript:void(0)" id="addscatit" onclick="addscatitem()"><i class="fa fa-plus-square-o" aria-hidden="true" style="font-size:20px;"></i> - Agregar </a></span><span>Sub-categorias</span></td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td colspan=3>
                                                                                  <table width="50%" id="scTbl" class="table table-striped table-hover">
                                                                                    <thead>
                                                                                      <tr>
                                                                                        <th width="10%"></th>
                                                                                        <th width="70%" style="font-size:16px;">Nombre</th>
                                                                                        <th width="10%"></th>
                                                                                        <th width="10%"></th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tfoot>
                                                                                      <tr>
                                                                                        <td width="10%"></td>
                                                                                        <td></td>
                                                                                        <td width="10%"></td>
                                                                                        <td width="10%"></td>
                                                                                      </tr>
                                                                                      <tr id="sctr-99">
                                                                                        <td colspan=4 id="sctdsave" align="center">
                                                                                                <button id="savecateg" class="btn btn-primary" type="button" onclick="savenewcateg()"><i class="fa fa-plus"></i> Guardar</button>
                                                                                                </td>
                                                                                      </tr>
                                                                                    </tfoot>
                                                                                    <tbody id="sctbdy">
                                                                                    </tbody>
                                                                                  </table>
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
