                    <script>
                      oTable = $('#dataTables-condivalist').dataTable({
                                                    'processing': true,
                                                    'serverSide': true,
                                                        'columnDefs': [{ 'sortable': false, 'searchable': false, 'targets': 1 }],
                                                    'ajax': {
                                                            'url':'_serv/servdata.php',
                                                            'data': function ( d ) {
                                                                    d.vview = 'vciva';
                                                            }
                                                    },
                                                    'aaSorting': [[ 0, 'asc' ]],
                                                    'fnDrawCallback': function (oSettings, json) {
                                                    }
                                       });
                        $('.menu > li').click(function(e){
                            var a = e.target.id;
                            chksess();
                            //desactivamos seccion y activamos elemento de menu
                            $('.menu li.active').removeClass('active');
                            $('.menu #'+a).addClass('active');
                            //ocultamos divisiones, mostramos la seleccionada
                            $('.content').css('display', 'none');
                            if(a == 'civalist'){
                                   clearciva();
                            }
                            $('.'+a).fadeIn();
                                        $('sidebar').removeClass('active');
                                        $('.overlay').fadeOut();
                        });
                        function savenewciva()
                        {
                         var civanom = $('#desccond').val();
                         var civaid = $('#civaid').val();
                         var rcivanom = document.getElementById('desccond');
                         if(isEmpty(rcivanom, 'Por Favor ingrese Nombre Cond.IVA')){
                                   $.ajax({
                                       type: 'POST',
                                       dataType:'json',
                                       url: '_serv/loadList.php',
                                       async:false,
                                       data: {t:'savenewciva',
                                              civanom:civanom
                                            },
                                       success: function (resp)
                                       {
                                         oTable.fnDraw();
                                        $('.menu li.active').removeClass('active');
                                        $('.menu #civalist').addClass('active');
                                        //ocultamos divisiones, mostramos la seleccionada
                                        $('.content').css('display', 'none');
                                        clearciva();
                                        $('.civalist').fadeIn();
                                        $('#msjalert').modal('hide');
                                      }
                                   });
                                }
                        }
                        function editciva(civaid) {
                                $.ajax({
                                    type: 'POST',
                                    dataType:'json',
                                    url: '_serv/loadList.php',
                                    async:false,
                                    data: {t:'editciva',civaid:civaid},
                                    success: function (resp)
                                    {
                                        $('#civaid').val(civaid);
                                        $('#desccond').val(resp.desccond);
                                        $('#civatdsave').html('<button id="addMoreOrder" class="btn btn-primary" type="button" onclick="saveupdciva()"><i class="fa fa-pencil-square-o"></i> Guardar</button>');
                                        $('.menu li.active').removeClass('active');
                                        $('.menu #newciva').addClass('active');
                                        $('.menu #newciva').html('Editar');
                                        $('#civahead').html('Editar Condicion IVA');
                                        //ocultamos divisiones, mostramos la seleccionada
                                        $('.content').css('display', 'none');
                                        $('.newciva').fadeIn();
                                        window.scrollTo(0,0);
                                    }
                                });
                        }
                        function saveupdciva()
                        {
                         var civanom = $('#desccond').val();
                         var civaid = $('#civaid').val();
                         var rcivanom = document.getElementById('desccond');
                         if(isEmpty(rcivanom, 'Por Favor ingrese Nombre Cond.IVA')){
                                   /*showaitalert();*/
                                   $.ajax({
                                       type: 'POST',
                                       dataType:'json',
                                       url: '_serv/loadList.php',
                                       async:false,
                                       data: {t:'saveupdciva',
                                              civaid:civaid,
                                              civanom:civanom
                                            },
                                       success: function (resp)
                                       {
                                         oTable.fnDraw();
                                        $('.menu li.active').removeClass('active');
                                        $('.menu #civalist').addClass('active');
                                        //ocultamos divisiones, mostramos la seleccionada
                                        $('.content').css('display', 'none');
                                        clearciva();
                                        $('.civalist').fadeIn();
                                        $('#msjalert').modal('hide');
                                      }
                                   });
                                }
                        }
                        function deleciva(civaid)
                        {
                                swal({
                                  title: 'Esta seguro?',
                                  text: '¡No podrás recuperar esta Condicion IVA!',
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
                                                  data: { t: 'deleciva',civaid:civaid},
                                                  success:function(data){
                                                        oTable.fnDraw();
                                                        $('.menu li.active').removeClass('active');
                                                        $('.menu #civalist').addClass('active');
                                                        //ocultamos divisiones, mostramos la seleccionada
                                                        $('.content').css('display', 'none');
                                                        clearciva();
                                                        $('.civalist').fadeIn();
                                                        $('#msjalert').modal('hide');
                                                  }
                                                }).done(function( msg ) {
                                                        console.log(msg);
                                                });
                                        swal('Borrada!', 'Esta Condicion IVA fue BORRADA.', 'success');
                                  } else {
                                                 return false;
                                  }
                                });
                        }
                        function clearciva() {
                                $('#civaid').val('0');
                                $('#desccond').val('');
                                $('#civatdsave').html('<button id="saveciva" class="btn btn-primary" type="button" onclick="savenewciva()"><i class="fa fa-plus"></i> Save</button>');
                                $('.menu #newciva').html('Nueva');
                                $('#civahead').html('Nueva Condicion IVA');
                        }
                    </script>
