                                        <script>
                                          oTable = $('#inventaio-list').dataTable({
                                                        'processing': true,
                                                        'serverSide': true,
                                                        'columnDefs': [{ 'sortable': false, 'searchable': false, 'targets': 4 },
                                                                       { 'sortable': false, 'searchable': false, 'targets': 5 },
                                                                       { 'sortable': false, 'searchable': true, 'visible': false, 'targets': [14]},
                                                                       { 'sortable': false, 'searchable': true, 'visible': false, 'targets': [15]}],
                                                        'ajax': {
                                                                 'url':'_serv/servdata.php',
                                                                 'data': function ( d ) {
                                                                         d.vview = 'vinvio';
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
                                                if(a == 'provlist'){
                                                       clearproveed();
                                                }
                                                $("."+a).fadeIn();
                                                            $("sidebar").removeClass("active");
                                                            $(".overlay").fadeOut();
                                            });
                                            function showinvin(artid,io)
                                            {
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:"json",
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'showinvin',
                                                               artid:artid,io:io},
                                                        success: function (response)
                                                        {
                                                          $(".psarea").html(response.rval);
                                                          $('.modal-dialog ').removeAttr("style");
                                                          $("#invmodal").modal('show');
                                                        }
                                                    });

                                            }                                            

                                            function saveinvinout(artid,io)
                                            {
                                                var ioqty = $("#ioqty").val();
                                                var idate = $("#inv_date").val();
                                                if (!$.isNumeric($("#ioqty").val())) {
                                                    alert("Ingrese Cantidad Valida");
                                                    return false;
                                                    }
                                                var oldqty = $("#old_qty").val();
                                                if(io > 0 && parseFloat(ioqty) > parseFloat(oldqty)) {
                                                    alert("Cantidad Max: "+oldqty);
                                                    return false;
                                                    }
                                                var vadj = 0;
                                                if ($('#invadj').is(':checked')){
                                                    vadj = 1;
                                                }
                                                var vref = $("#invref").val();
                                                var rvref = document.getElementById('invref');
                                                if(isEmpty(rvref, "Por Favor ingrese Referencia")){
                                                   $.ajax({
                                                        type: 'POST',
                                                        dataType:"json",
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'saveinvinout',
                                                               artid:artid,
                                                               io:io,
                                                               idate:idate,
                                                               ioqty:ioqty,
                                                               vadj:vadj,
                                                               vref:vref},
                                                        success: function (response)
                                                        {
                                                         if(response.rval == 'ok')
                                                          {
                                                              oTable.fnDraw();
                                                            $("#invmodal").modal('hide');
                                                          } else {
                                                            alert('Invalid Date');
                                                            return false;
                                                          }
                                                        }
                                                    });
                                                }
                                            }

                                            function showinviolist(artid) {
                                                    $('.psarea').html('');
                                                    $.ajax({
                                                        type: 'POST',
                                                        dataType:"json",
                                                        url: '_serv/loadList.php',
                                                        async:false,
                                                        data: {t:'showinviolist',artid:artid},
                                                        success: function (res)
                                                        {
                                                            $('#ModalLabel').html('Raw Material Inventory List');
                                                            $('.psarea').html(res.rval);
                                                            $('#invmodal').modal('show');
                                                            $('.modal-dialog ').css('width', '85%');
                                                            $('.modal-dialog ').css('height', '90%');
                                                            //$('.modal-dialog ').css('margin', '0');
                                                            //$('.modal-dialog ').css('padding', '0');
                                                            $('.modal-content ').css('height', 'auto');
                                                            //$('.modal-content ').css('min-height', '100%');
                                                            $('.modal-content ').css('border-radius', '0');
                                                            //var wh = Math.round(($( window ).height() * 0.80));
                                                            //$('#ifrmodal').css('height', wh + 'px');
                                                        }
                                                    });
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

                                            function genlistinvxls(){
                                                var catid=$("#qcateg").val();
                                                var scatid=$("#qsubcat").val();
                                                //alert("ct_excel.php?companyname="+escape(companyname)+"&viewoc="+escape(viewoc)+"&search="+escape(search))
                                                window.open("xls/listinvxls.php?catid="+escape(catid)+"&scatid="+escape(scatid));
                                            }
                                        </script>
                                        
