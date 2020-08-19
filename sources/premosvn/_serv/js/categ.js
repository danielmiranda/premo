                                        <script>
                                          oTable = $('#dataTables-catego').dataTable({
                                                        'processing': true,
                                                        'serverSide': true,
                                                        'columnDefs': [{ 'sortable': false, 'searchable': false, 'targets': 2 }],
                                                        'ajax': {
                                                                 'url':'_serv/servdata.php',
                                                                 'data': function ( d ) {
                                                                         d.vview = 'vcateg';
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
                                                if(a == 'categlist'){
                                                       clearcateg();
                                                }
                                                $("."+a).fadeIn();
                                                            $("sidebar").removeClass("active");
                                                            $(".overlay").fadeOut();
                                            });
                                            function savenewcateg()
                                            {
                                             var catnom = $('#categnom').val();
                                             var catid = $('#categid').val();
                                             var rcatnom = document.getElementById('categnom');
                                             if(isEmpty(rcatnom, 'Por Favor ingrese Nombre Categoria')){
                                                       var dataitem = '';
                                                       
                                                       $('.sctritems').each(function () {
                                                           var tr_val = $(this).attr('id');
                                                           var tr_data = tr_val.split('-');
                                                           var trid = tr_data[1];
                                                           var vscnom = $('#scnom-'+trid).val();
                                                           dataitem += vscnom+'|';
                                                       });
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'savenewcateg',
                                                                  catnom:catnom,
                                                                  dataitem:dataitem
                                                                },
                                                           success: function (resp)
                                                           {
                                                             dcmaxrow = 0;
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #categlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearcateg();
                                                            $('.categlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function editcateg(catid) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'editcateg',catid:catid},
                                                        success: function (resp)
                                                        {
                                                            $('#categid').val(catid);
                                                            $('#categnom').val(resp.categdescr);
                                                            $('#ctddel').html(resp.vcatdel);
                                                            $('#sctbdy').html(resp.vresu);
                                                            $('#sctdsave').html('<button id="addMoreOrder" class="btn btn-primary" type="button" onclick="saveupdcat()"><i class="fa fa-pencil-square-o"></i> Guardar</button>');
                                                            dcmaxrow = resp.reng;
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #newcateg').addClass('active');
                                                            $('.menu #newcateg').html('Editar');
                                                            $('#cathead').html('Editar Categoria');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            $('.newcateg').fadeIn();
                                                            window.scrollTo(0,0);
                                                        }
                                                    });
                                            }
                                            function saveupdcat()
                                            {
                                             var catnom = $('#categnom').val();
                                             var catid = $('#categid').val();
                                             var rcatnom = document.getElementById('categnom');
                                             if(isEmpty(rcatnom, 'Por Favor ingrese Nombre Categoria')){
                                                       /*showaitalert();*/
                                                       var dataitem = '';
                                                       
                                                       $('.sctritems').each(function () {
                                                           var tr_val = $(this).attr('id');
                                                           var tr_data = tr_val.split('-');
                                                           var trid = tr_data[1];
                                                           var vscnom = $('#scnom-'+trid).val();
                                                           dataitem += trid+':'+vscnom+'|';
                                                       });
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'saveupdcat',
                                                                  catid:catid,
                                                                  catnom:catnom,
                                                                  dataitem:dataitem
                                                                },
                                                           success: function (resp)
                                                           {
                                                             dcmaxrow = 0;
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #categlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearcateg();
                                                            $('.categlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function clearcateg() {
                                                    $('#categid').val('0');
                                                    $('#categnom').val('');
                                                    $('#ctddel').html('');
                                                    $('#sctbdy').html('');
                                                    $('#sctdsave').html('<button id="savecateg" class="btn btn-primary" type="button" onclick="savenewcateg()"><i class="fa fa-plus"></i> Guardar</button>');
                                                    dcmaxrow = 0;
                                                    $('#addrfqit').removeClass('rfqite');
                                                    $('.menu #newcateg').html('Nueva');
                                                    $('#cathead').html('Categoria Nueva');
                                            }
                                            function delecateg(catid)
                                            {
                                                    swal({
                                                      title: 'Esta seguro?',
                                                      text: '¡No podrás recuperar esta Categoria!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#DD6B55',
                                                      confirmButtonText: 'Si, Borrala',
                                                      cancelButtonText: 'No, cancelar pf',
                                                      closeOnConfirm: true,
                                                      closeOnCancel: true
                                                    },
                                                    function(isConfirm){
                                                      if (isConfirm) {
                                                              
                                                                    $.ajax({
                                                                      method: 'POST',
                                                                    dataType:'json',
                                                                      url: path+'loadList.php',
                                                                      data: { t: 'delecateg',catid:catid},
                                                                      success:function(data){
                                                                            oTable.fnDraw();
                                                                            $('.menu li.active').removeClass('active');
                                                                            $('.menu #categlist').addClass('active');
                                                                            //ocultamos divisiones, mostramos la seleccionada
                                                                            $('.content').css('display', 'none');
                                                                            clearcateg();
                                                                            $('.categlist').fadeIn();
                                                                            $('#msjalert').modal('hide');
                                                                      }
                                                                    }).done(function( msg ) {
                                                                            console.log(msg);
                                                                    });
                                                            swal('Borrada!', 'Esta Categoria fue BORRADA.', 'success');
                                                      } else {
                                                                     return false;
                                                      }
                                                    });
                                            }
                                            function addscatitem()
                                            {
                                                    var i = 0;
                                                    var trdata = '';
                                                    var tbl = document.getElementById('scTbl').getElementsByTagName('tbody')[0];
                                                    var lastRow = tbl.rows.length;
                                                    dcmaxrow = dcmaxrow + 1;
                                                    var newrow = dcmaxrow;
                                                    var tr = tbl.insertRow(-1);
                                                    tr.id = 'sctr-' + newrow;
                                                    tr.className = 'sctritems';
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'addscitem',newrow:newrow},
                                                        success: function (response)
                                                        {
                                                            $('#sctr-'+newrow).html(response.resu);
                                                        }
                                                    });
                                            }
                                            function showpdelalert(catid,row) {
                                                var alertmsg = '<div><br><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:30px;"></i><br><br>'
                                                              +'Desea eliminar este item?<br><br>'
                                                              +'<button type="button" class="btn btn-default btnyesno" style="float:left" onclick="delscitem('+catid+','+row+')">Si</button>'
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
                                            function delscitem(catid,rowd)
                                            {
                                                  if(catid > 0){
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'delscitem',catid:catid,scid:rowd},
                                                        success: function (response)
                                                        {
                                                            var vres = response.stat;
                                                            oTable.fnDraw();
                                                        }
                                                    });
                                                  }
                                                  var row = document.getElementById('sctr-'+rowd);
                                                  row.parentNode.removeChild(row);
                                                  $('#msjalert').modal('hide');
                                                  var tbl = document.getElementById('scTbl').getElementsByTagName('tbody')[0];
                                                  var lastRow = tbl.rows.length;
                                            }
                                        </script>
