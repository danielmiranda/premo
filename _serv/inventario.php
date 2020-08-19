                                    <ul class="menu">
                                        <li id="inviolist" class="active">Inventario</li>
                                    </ul>
                                    <span class="clear"></span>
                                        <div class="row content inviolist">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        INVENTARIO
                                                            <div style="float:right; position:unset">
                                                              <a href="javascript:void(0);" onclick="genlistinvxls()">XLS</a>
                                                            </div>
                                                            <div style="float:right; position:unset">
                                                                    <span id="vcateg" style="margin-right:20px;"><select name="qcateg" id="qcateg" class ="select2" style="width:200px" onchange="selcateg(this.value)"><option value="0">Categorias</option></select></span>
                                                                    <span id="vsubcat" style="margin-right:20px;"><select name="qsubcat" id="qsubcat" class ="select2" style="width:200px" onchange="selsubcateg(this.value)"><option value="0">Sub-Categorias</option></select></span>
                                                            </div>
                                                    </div>
                                                    <div id="divproveed" class="panel-body <?php echo $tabadm;?>">
                                                        <table width="100%" class="table table-striped table-bordered table-hover" id="inventaio-list">
                                                            <thead>
                                                                <tr>
                                                                <th>Prod ID</th>
                                                                <th>Descripcion</th>
                                                                <th>Unidad Stock</th>
                                                                <th class="text-right">Stock actual</th>
                                                                <th>Inv. Entrada</th>
                                                                <th>Inv. Salida</th>
                                                                <th>Ultima actualizacion</th>
                                                                <th>Cons.Prom.</th> 
                                                                <th>Cons.Capt</th>
                                                                <th>Inv.Min</th>
                                                                <th>Ciclo Reemp</th> 
                                                                <th>Dias inv</th>
                                                                <th>Dias inv neto</th>
                                                                <th>Prox.Cpra</th>
                                                                <th>categ</th>
                                                                <th>subcat</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
