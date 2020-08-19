                <ul class="menu">
                    <li id="civalist" >Lista Cond.IVA</li>
                    <li id="newciva" >Nueva</li>
                </ul>
                <span class="clear"></span>
                    <div class="row  content civalist">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="display:table;margin:0 auto;width: 100%;">
                                    Lista Condicion IVA
                                        <div style="float:right; position:unset">
                                        </div>
                                </div>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-condivalist">
                                        <thead>
                                            <tr>
                                                <th>Condicion</th>
                                                <th>Opciones</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  content newciva" style="display: none;">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div id="civahead" class="panel-heading" style="display:table;margin:0 auto;width: 100%;">
                                    Nueva Condicion IVA
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td>
                                                  <table width="50%" class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                      <td width="20%"></td>
                                                      <td width="40%"></td>
                                                      <td width="40%"></td>
                                                    </tr>
                                                    <tr>
                                                      <td style="text-align:right;vertical-align:middle"></td>
                                                      <td>
                                                        <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Condicion</label>
                                                              <input name="civaid" id="civaid" type="hidden" value="0">
                                                              <input class="form-control" id="desccond" placeholder="" value="">
                                                          </div>
                                                        </div>
                                                      </td>
                                                      <td style="text-align:center;vertical-align:middle" id="tdcustlogo">
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td style="text-align:right;vertical-align:middle"></td>
                                                      <td>
                                                        <table width="100%" style="border-collapse: collapse;">
                                                            <tr id="tr-99">
                                                              <td id="civatdsave">
                                                               <button id="saveciva" class="btn btn-primary" type="button" onclick="savenewciva()"><i class="fa fa-plus"></i> Save</button>
                                                              </td>
                                                            </tr>
                                                        </table>
                                                      </td>
                                                      <td style="text-align:right;vertical-align:middle"></td>
                                                    </tr>
                                                  </table>
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
