                                        <script>
                                          oTable = $('#dataTables-artic').dataTable({
                                                        'processing': true,
                                                        'serverSide': true,
                                                        'columnDefs': [{ 'sortable': false, 'searchable': false, 'targets': 7 },
                                                                       { 'sortable': false, 'searchable': true, 'visible': false, 'targets': [9]},
                                                                       { 'sortable': false, 'searchable': true, 'visible': false, 'targets': [10]}
                                                                      ],
                                                        'ajax': {
                                                                 'url':'_serv/servdata.php',
                                                                 'data': function ( d ) {
                                                                         d.vview = 'vartic';
                                                                         d.searchcateg = $("#qcateg").val();
                                                                         d.searchscateg = $("#qsubcat").val();
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
                                                if(a == 'artlist'){
                                                       clearartic();
                                                }
                                                $("."+a).fadeIn();
                                                            $("sidebar").removeClass("active");
                                                            $(".overlay").fadeOut();
                                            });
                                            function savenewart()
                                            {
                                             var descrartic = $('#vdescrartic').val();
                                             var codartid = $('#vcodartid').val();
                                             var icateg = $('#icateg').val();
                                             var isubcat = $('#isubcat').val();
                                             var iconscapt = $('#iconscapt').val();
                                             var iunidcpra = $('#iunidcpra').val();
                                             var iunideq = $('#iunideq').val();
                                             var istkunid = $('#istkunid').val();
                                             var diasrecu = $('#vdiasrecu').val();
                                             var recumarg = $('#vrecumarg').val();
                                             var iprecart = $('#iprecart').val();
                                             var stockart = $('#vstockart').val();
                                             var codprov  = $('#vcodprov').val();
                                             var codarticulo  = $('#codarticulo').val();
                                             console.log(codarticulo);

                                             var rdescrartic = document.getElementById('vdescrartic');
                                             var rprecart = document.getElementById('iprecart');
                                             if(isEmpty(rdescrartic, 'Por Favor ingrese Descripcion Articulo')){
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'savenewart',
                                                                  descrartic:descrartic,
                                                                  codprov:codprov,
                                                                  codarticulo:codarticulo,
                                                                  icateg:icateg,
                                                                  isubcat:isubcat,
                                                                  iconscapt:iconscapt,
                                                                  iunidcpra:iunidcpra,
                                                                  iunideq:iunideq,
                                                                  istkunid:istkunid,
                                                                  diasrecu:diasrecu,
                                                                  recumarg:recumarg,
                                                                  iprecart:iprecart
                                                                },
                                                           success: function (resp)
                                                           {
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #artlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearartic();
                                                            $('.artlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function editart(codartid) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'editart',codartid:codartid},
                                                        success: function (resp)
                                                        {
                                                            $('#vdescrartic').val(resp.descrartic);
                                                            $('#vcodartid').val(resp.codartid);
                                                            $('#vicateg').html(resp.icateg);
                                                            $('#visubcat').html(resp.isubcat);
                                                            $('#iconscapt').val(resp.iconscapt);
                                                            $('#viunidcpra').html(resp.iunidcpra);
                                                            $('#iunideq').val(resp.iunideq);
                                                            $('#vistkunid').html(resp.istkunid);
                                                            $('#vdiasrecu').val(resp.diasrecu);
                                                            $('#vrecumarg').val(resp.recumarg);
                                                            $('#iprecart').val(resp.iprecart);
                                                            $('#vstockart').val(resp.stockart);
                                                            $('#vstockmin').val(resp.stockmin);
                                                            $('#vconsavg').val(resp.consprom);
                                                            $('#vcodprov').val(resp.vcodprov);
                                                            $('#codarticulo').val(resp.codarticulo);
                                                            $("#icateg").select2();
                                                            $("#isubcat").select2();
                                                            $("#iunidcpra").select2();
                                                            $("#istkunid").select2();
                                                            $("#iconscapt").removeAttr("readonly");
                                                            $("#vdiasrecu").removeAttr("readonly");
                                                            $("#vrecumarg").removeAttr("readonly");
                                                            //$("#vcodprov").removeAttr("readonly");
                                                            $("#codarticulo").removeAttr("readonly");
                                                            $('#artictdsave').html('<button id="saveartic" class="btn btn-primary" type="button" onclick="saveupdart()"><i class="fa fa-pencil-square-o"></i> Guardar</button>');
                                                            dcmaxrow = resp.reng;
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #newartic').addClass('active');
                                                            $('.menu #newartic').html('Editar');
                                                            $('#arthead').html('Editar Art&iacute;culo');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            $('.newartic').fadeIn();
                                                            window.scrollTo(0,0);
                                                        }
                                                    });
                                            }
                                            function saveupdart()
                                            {
                                             var descrartic = $('#vdescrartic').val();
                                             var codartid = $('#vcodartid').val();
                                             var icateg = $('#icateg').val();
                                             var isubcat = $('#isubcat').val();
                                             var iconscapt = $('#iconscapt').val();
                                             var iunidcpra = $('#iunidcpra').val();
                                             var iunideq = $('#iunideq').val();
                                             var istkunid = $('#istkunid').val();
                                             var diasrecu = $('#vdiasrecu').val();
                                             var recumarg = $('#vrecumarg').val();
                                             var iprecart = $('#iprecart').val();
                                             var stockart = $('#vstockart').val();
                                             var stockmin = $('#vstockmin').val();
                                             var codprov  = $('#vcodprov').val();
                                             var codarticulo  = $('#codarticulo').val();

                                             var rdescrartic = document.getElementById('vdescrartic');
                                             var rprecart = document.getElementById('iprecart');
                                             if(isEmpty(rdescrartic, 'Por Favor ingrese Descripcion Articulo')){
                                                       $.ajax({
                                                           type: 'POST',
                                                           dataType:'json',
                                                           url: '_serv/loadList.php',
                                                           async:false,
                                                           data: {t:'saveupdart',
                                                                  codartid:codartid,
                                                                  descrartic:descrartic,
                                                                  codprov:codprov,
                                                                  codarticulo:codarticulo,
                                                                  icateg:icateg,
                                                                  isubcat:isubcat,
                                                                  iconscapt:iconscapt,
                                                                  iunidcpra:iunidcpra,
                                                                  iunideq:iunideq,
                                                                  istkunid:istkunid,
                                                                  diasrecu:diasrecu,
                                                                  recumarg:recumarg,
                                                                  iprecart:iprecart
                                                                },
                                                           success: function (resp)
                                                           {
                                                             oTable.fnDraw();
                                                            $('.menu li.active').removeClass('active');
                                                            $('.menu #artlist').addClass('active');
                                                            //ocultamos divisiones, mostramos la seleccionada
                                                            $('.content').css('display', 'none');
                                                            clearartic();
                                                            $('.artlist').fadeIn();
                                                            $('#msjalert').modal('hide');
                                                          }
                                                       });
                                                    }
                                            }
                                            function deleart(artid) 
                                            {
                                                    swal({
                                                      title: 'Esta seguro?',
                                                      text: '¡No podrás recuperar este Articulo!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#DD6B55',
                                                      confirmButtonText: 'Si, Borralo',
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
                                                                      data: { t: 'deleart',artid:artid},
                                                                      success:function(data){
                                                                            oTable.fnDraw();
                                                                            $('.menu li.active').removeClass('active');
                                                                            $('.menu #artlist').addClass('active');
                                                                            //ocultamos divisiones, mostramos la seleccionada
                                                                            $('.content').css('display', 'none');
                                                                            clearartic();
                                                                            $('.artlist').fadeIn();
                                                                            $('#msjalert').modal('hide');
                                                                      }
                                                                    }).done(function( msg ) {
                                                                            console.log(msg);
                                                                    });
                                                            swal('Borrada!', 'Este Articulo fue BORRADO.', 'success');
                                                      } else {
                                                                     return false;
                                                      }
                                                    });
                                            }
                                            function clearartic() {
                                                     $('#vdescrartic').val('');
                                                     $('#vcodartid').val('0');
                                                     $('#vicateg').html(vicateg);
                                                     $('#visubcat').html(visubcat);
                                                     $("#icateg").select2();
                                                     $("#isubcat").select2();
                                                     $('#iconscapt').val('0');
                                                     $('#vstockmin').val('0');
                                                     $('#vconsavg').val('0');
                                                     $('#iunideq').val('1');
                                                     $('#viunidcpra').html(viunidcpra);
                                                     $('#vistkunid').html(vistkunid);
                                                     $("#iunidcpra").select2();
                                                     $("#istkunid").select2();
                                                     $('#vdiasrecu').val('0');
                                                     $('#vrecumarg').val('0');
                                                     $('#vcodprov').val('');
                                                     $('#codarticulo').val('');
                                                     $('#iprecart').val('0.00');
                                                     $('#artictdsave').html('<button id="saveartic" class="btn btn-primary" type="button" onclick="savenewart()"><i class="fa fa-plus"></i> Guardar</button>');

                                                     $("#iconscapt").attr("readonly","readonly");
                                                     $("#vdiasrecu").attr("readonly","readonly");
                                                     $("#vrecumarg").attr("readonly","readonly");
                                                    // $("#vcodprov").attr("readonly","readonly");
                                                    //  $("#codarticulo").attr("readonly","readonly");

                                                    $('.menu #newartic').html('Nuevo');
                                                    $('#arthead').html('Art&iacute;culo Nuevo');
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
                                            function selcateg(catid)
                                            {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'selcateg',catid:catid},
                                                        success: function (response)
                                                        {
                                                            var vres = response.stat;
                                                            $('#vsubcat').html(response.vsubcat);
                                                        }
                                                    });
                                                    oTable.fnDraw();
                                                    $("#qsubcat").select2();
                                            }
                                            function selsubcateg(scatid)
                                            {
                                                oTable.fnDraw();
                                            }
                                            function selicateg(catid)
                                            {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:'json',
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'selicateg',catid:catid},
                                                        success: function (response)
                                                        {
                                                            var vres = response.stat;
                                                            $('#visubcat').html(response.vsubcat);
                                                        }
                                                    });
                                                    $("#isubcat").select2();
                                            }
                                            function genlistartxls(){
                                                var catid=$("#qcateg").val();
                                                var scatid=$("#qsubcat").val();
                                                //alert("ct_excel.php?companyname="+escape(companyname)+"&viewoc="+escape(viewoc)+"&search="+escape(search))
                                                window.open("xls/listartxls.php?catid="+escape(catid)+"&scatid="+escape(scatid));
                                            }
                                            function callUploadxls() {
                                                //alert('called');
                                                $('#upload_xls').click();
                                                $("#upload_xls").off().on('change', function (event) {
                                                    event.stopPropagation(); // Stop stuff happening
                                                    event.preventDefault(); // Totally stop stuff happening

                                                    // Variable to store your files
                                                    var files;
                                                    //check uploaded file extention
                                                    var ext = $('#upload_xls').val().split('.').pop().toLowerCase();

                                                    if ($.inArray(ext, ['xls', 'xlsx']) == -1) {
                                                        alert('invalid extension! Only jpg|pdf|ai files are allowed');
                                                        $('#upload_artwork_img_0').val('');
                                                        $('#runTimePreview_0').html('');
                                                    } else {
                                                        files = event.target.files;
                                                        // Create a formdata object and add the files
                                                        var data = new FormData();
                                                        $.each(files, function (key, value) {
                                                            data.append(key, value);
                                                        });
                                                        //data.append('poid', poid);
                                                        //data.append('poit', poit);
                                                        //data.append('deid', deid);
                                                        var URL = "xls/readartxls.php";

                                                        $.ajax({
                                                            url: URL, // Url to which the request is send
                                                            type: "POST", // Type of request to be send, called as method
                                                            data: data,
                                                            cache: false,
                                                            dataType: 'html',
                                                            processData: false, // Don't process the files
                                                            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                                                            success: function (response) {
                                                                oTable.fnDraw();
                                                              alert('ACTUALIZADO');
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        </script>
