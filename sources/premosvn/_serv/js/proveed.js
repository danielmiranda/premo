                                        <script>
                                          /*dcmaxrow = 0;*/
                                          oTable = $('#dataTables-proveed').dataTable({
                                                        'processing': true,
                                                        'serverSide': true,
                                                        'columnDefs': [{ 'sortable': false, 'searchable': false, 'targets': 4 }],
                                                        'ajax': {
                                                                 'url':'_serv/servdata.php',
                                                                 'data': function ( d ) {
                                                                         d.vview = 'vproveed';
                                                                }
                                                        },
                                                        'aaSorting': [[ 0, 'asc' ]],
                                                        'fnDrawCallback': function (oSettings, json) {
                                                   }
                                            });
                                            $(".menu > li").click(function(e){
                                                var a = e.target.id;
                                                chksess();
                                                //desactivamos seccion y activamos elemento de menu
                                                $(".menu li.active").removeClass("active");
                                                $(".menu #"+a).addClass("active");
                                                //ocultamos divisiones, mostramos la seleccionada
                                                $(".content").css("display", "none");
                                                if(a == 'provlist'){
                                                       clearproveed();
                                                }
                                                $("."+a).fadeIn();
                                                            $("sidebar").removeClass("active");
                                                            $(".overlay").fadeOut();
                                            });
                                            function clearproveed() {

                                                    $('#vprovid').val('0');
                                                    $('#vnombreprov').val('');
                                                    $('#vcuitprov').val('');
                                                    $('#vicond').html(vcondiva);
                                                    $('#vdomcalle').val('');
                                                    $('#vdomid').val('0');
                                                    $('#viloc').html(vloc);
                                                    $('#vnomprov').val('');
                                                    $('#vnompais').val('');
                                                    $('#contbdy').html('');
                                                    $("#vcondiva").select2();
                                                    $("#vlocid").select2();
                                                    $('#provtdsave').html('<button id="saveprov" class="btn btn-primary" type="button" onclick="savenewprov()"><i class="fa fa-plus"></i> Guardar</button>');
                                                    $('.menu #newproveed').html('Nuevo');
                                                    $('#provhead').html('Proveedor Nuevo');
                                            }
                                            function savenewprov()
                                            {
                                             var provid = $('#vprovid').val();
                                             var nombreprov = $('#vnombreprov').val();
                                             var cuitprov = $('#vcuitprov').val();
                                             var condiva = $('#vcondiva').val();
                                             var domcalle = $('#vdomcalle').val();
                                             var domid = $('#vdomid').val();
                                             var locid = $('#vlocid').val();
                                             var rnombreprov = document.getElementById('vnombreprov');
                                             var rprecart = document.getElementById('vcuitprov');
                                             if(isEmpty(rnombreprov, 'Por Favor ingrese Nombre Proveedor')){
                                                       var dataitem = '';
                                                       $('.conttritems').each(function () {
                                                           var tr_val = $(this).attr('id');
                                                           var tr_data = tr_val.split('-');
                                                           var trid = tr_data[1];
                                                           var vtcid = $('#vtcid-'+trid).val();
                                                           var contnom = $('#contnom-'+trid).val();
                                                           dataitem += vtcid+'-'+contnom+'|';
                                                       });
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'savenewprov',
                                                                  nombreprov:nombreprov,
                                                                  cuitprov:cuitprov,
                                                                  condiva:condiva,
                                                                  domcalle:domcalle,
                                                                  domid:domid,
                                                                  locid:locid,
                                                                  dataitem:dataitem
                                                                },
                                                           success: function (resp)
                                                           {
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #provlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearproveed();
                                                            $('.provlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function editprov(provid) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'editprov',provid:provid},
                                                        success: function (resp)
                                                        {
                                                            $('#vprovid').val(provid);
                                                            $('#vnombreprov').val(resp.nombreprov);
                                                            $('#vcuitprov').val(resp.cuitprov);
                                                            $('#vicond').html(resp.vcondiva);
                                                            $('#vdomcalle').val(resp.domcalle);
                                                            $('#vdomid').val(resp.domid);
                                                            $('#viloc').html(resp.vloc);
                                                            $('#vnomprov').val(resp.pcianombre);
                                                            $('#vnompais').val(resp.paisnombre);
                                                            $('#contbdy').html(resp.vresu);
                                                            $("#vcondiva").select2();
                                                            $("#vlocid").select2();
                                                            $('#provtdsave').html('<button id="saveprov" class="btn btn-primary" type="button" onclick="saveupdprov()"><i class="fa fa-plus"></i> Guardar</button>');
                                                            dcmaxrow = resp.reng;
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #newproveed').addClass('active');
                                                            $('.menu #newproveed').html('Editar');
                                                            $('#cathead').html('Editar Proveedor');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            $('.newproveed').fadeIn();
                                                            window.scrollTo(0,0);

                                                        }
                                                    });
                                            }
                                            function saveupdprov()
                                            {
                                             var provid = $('#vprovid').val();
                                             var nombreprov = $('#vnombreprov').val();
                                             var cuitprov = $('#vcuitprov').val();
                                             var condiva = $('#vcondiva').val();
                                             var domcalle = $('#vdomcalle').val();
                                             var domid = $('#vdomid').val();
                                             var locid = $('#vlocid').val();
                                             var rnombreprov = document.getElementById('vnombreprov');
                                             var rprecart = document.getElementById('vcuitprov');
                                             if(isEmpty(rnombreprov, 'Por Favor ingrese Nombre Proveedor')){
                                                       var dataitem = '';
                                                       $('.conttritems').each(function () {
                                                           var tr_val = $(this).attr('id');
                                                           var tr_data = tr_val.split('-');
                                                           var trid = tr_data[1];
                                                           var vtcid = $('#vtcid-'+trid).val();
                                                           var contnom = $('#contnom-'+trid).val();
                                                           dataitem += vtcid+'-'+contnom+'|';
                                                       });
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'saveupdprov',
                                                                  provid:provid,
                                                                  nombreprov:nombreprov,
                                                                  cuitprov:cuitprov,
                                                                  condiva:condiva,
                                                                  domcalle:domcalle,
                                                                  domid:domid,
                                                                  locid:locid,
                                                                  dataitem:dataitem
                                                                },
                                                           success: function (resp)
                                                           {
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #provlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearproveed();
                                                            $('.provlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function selloc(locid)
                                            {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'selloc',locid:locid},
                                                        success: function (response)
                                                        {
                                                            var vres = response.stat;
                                                            $('#vnomprov').val(response.vnomprov);
                                                            $('#vnompais').val(response.vnompais);
                                                        }
                                                    });
                                            }
                                            function addscontitem()
                                            {
                                                    var i = 0;
                                                    var trdata = '';
                                                    var tbl = document.getElementById('contTbl').getElementsByTagName('tbody')[0];
                                                    var lastRow = tbl.rows.length;
                                                    dcmaxrow = dcmaxrow + 1;
                                                    var newrow = dcmaxrow;
                                                    var tr = tbl.insertRow(-1);
                                                    tr.id = 'conttr-' + newrow;
                                                    tr.className = 'conttritems';
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'addcontitem',newrow:newrow},
                                                        success: function (response)
                                                        {
                                                            $('#conttr-'+newrow).html(response.resu);
                                                            $('#vtcid-'+newrow).select2();
                                                        }
                                                    });
                                            }
                                            function showpdelalert(provid,row) {
                                                var alertmsg = '<div><br><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:30px;"></i><br><br>'
                                                              +'Desea eliminar este item?<br><br>'
                                                              +'<button type="button" class="btn btn-default btnyesno" style="float:left" onclick="delcontitem('+provid+','+row+')">Si</button>'
                                                              +'<button type="button" class="btn btn-default btnyesno" style="float:right" data-dismiss="modal">No</button></div>';
                                                    $('#msjcontent').html(alertmsg);
                                                    $('.commentsBox').css('width', '300px');
                                                    $('.commentsBox').css('height', '190px');
                                                    $('.commentsBox').css('padding', '10px');
                                                    $('.commentsBox').css('background-color', '#000');
                                                    $('.commentsBox').css('color', '#FFF');
                                                    $('.commentsBox').css('font-size', '18px');
                                                    $('.btnyesno').css('background-color', '#000');
                                                    $('.btnyesno').css('color', '#FFF');
                                                    var wh = Math.round(($( window ).height() * 0.30));
                                                    $('.modal-content2').css('margin-top', wh + 'px');
                                                    $('#msjalert').modal('show');
                                                    
                                            }
                                            function delcontitem(provid,rowd)
                                            {
                                                  if(provid > 0){
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'delcontitem',provid:provid,contid:rowd},
                                                        success: function (response)
                                                        {
                                                            var vres = response.stat;
                                                        }
                                                    });
                                                  }
                                                  var row = document.getElementById('conttr-'+rowd);
                                                  row.parentNode.removeChild(row);
                                                  $('#msjalert').modal('hide');
                                                  var tbl = document.getElementById('contTbl').getElementsByTagName('tbody')[0];
                                                  var lastRow = tbl.rows.length;
                                            }
                                        </script>
                                        
