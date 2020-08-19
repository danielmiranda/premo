      
$(document).ready(function() {

   formid = $('#formid').val();
   xurg='';
   xdshd='';

    num_seconds = 0;
/*
     oTable = $("#dataTables-catego").dataTable({
                "processing": true,
                "serverSide": true,
                "columnDefs": [{ 'sortable': false, "searchable": false, "targets": 2 }],
                "ajax": {
                         "url":"_serv/servdata.php",
                         "data": function ( d ) {
                                 d.vview = "vcateg";
                        }
                },
                "aaSorting": [[ 0, "asc" ]],
                "fnDrawCallback": function (oSettings, json) {
           }
    });
/*   
    oTable1 = $("#dataTables-orddsgr").dataTable({
               "processing": true,
               "serverSide": true,
               "columnDefs": [{ "searchable": false, "targets": 12 },{ "searchable": false, "targets": 13 },{ 'sortable': false, 'searchable': true, 'visible': false, 'targets': [14]}],
               "ajax": {
                        "url":"_serv/servdata.php",
                        "data": function ( d ) {
                                d.vview = "pord2";
                                d.extra_search = $("#ostatus").val();
                       }
               },
               "aaSorting": [[ 0, "asc" ]],
               "fnDrawCallback": function (oSettings, json) {
          }
    });
    oTable2 = $("#dataTables-cuslist").dataTable({
                "processing": true,
                "serverSide": true,
                "columnDefs": [{ "searchable": false, "targets": 9 }],
                "ajax": {
                         "url":"_serv/servdata.php",
                         "data": function ( d ) {
                                 d.vview = "cus";
                        }
                },
                "aaSorting": [[ 0, "asc" ]],
                "fnDrawCallback": function (oSettings, json) {
                  //checkoidbill();
           }
    });
*/
        $("#usrid").select2();
        $("#pcustid").select2();
        $("#prfqid").select2();
        $("#qshmth").select2();
        $("#pshmth").select2();
        $("#dsgartid").select2();
        $("#qpromocode").select2();
        $("#ppromocode").select2();
        $("#promotyp").select2();
        $("#statpromo").select2();
        $("#typecont").select2();
        $("#pnprn").select2();
        $("#pndto").select2();
        $("#pnptyp").select2();
        $("#pnphw").select2();
        $("#logdpt").select2();
        $("#logview").select2();
        $("#incont").select2();
/*        
        $("#qreqdate").datepicker(
        {
                format: "yyyy-mm-dd", 
                weekStart:0,
                autoclose: true,
                daysOfWeekDisabled: [0,6]
        });


        $('#qcusemail').typeahead({
            source: function (query, result) {
                        $.ajax({
                           url: "_serv/loadList.php",
                           data: {t:'getthmail',query:query},
                           dataType: "json",
                           type: "POST",
                           async:false,
                           success: function (data) {
                                result($.map(data, function (item) {
                                return item;
                        }));
                        }
                        });
            }
        });
*/
/*
    $('#cusemail').val('');
    $('#custid').val('0');
    //$('#cuscompany').val('');
    //$('#cusname').val('');
    $('#ordcli').val('');
    $('#reqdate').val('');
    $('#vtot').val('0');
    $('#vtw').val('0');
    $('#vzip').val('0');
    $('#zip').val('');
    $('#shmth').val('0');
    $('#td-98').html('$0.00');
    $('#trt-99').html('$0.00');       
    $('#trw-99').html('0.00');       
    $('#rfqTbl tbody').html('');
    dcmaxrow = 0;
         //       var wh = Math.round(($( window ).height()));
         //       alert(wh);
    vcontainer=$('#container').html();
//  $('#Login-Form').parsley();
//  $('#Signin-Form').parsley();
//  $('#Forgot-Password-Form').parsley();
    	
     clearord();
     clearcus();
     clearpcod();
     clearcont();
     clearpn();
*/
     clearcateg();
  $('#email').val('');  	
  $('#login-password').val('');  	
  $('#namereg').val('');  	
  $('#emailreg').val('');  	
  $('#passwdreg').val('');  	
  $('#confirm-passwd').val('');  	

  $('#signupModal').click(function(){			    		
  	$('#login-modal-content').fadeOut('fast', function(){
           $('#namereg').val('');  	
           $('#emailreg').val('');  	
           $('#passwdreg').val('');  	
           $('#confirm-passwd').val('');  	
  	   $('#signup-modal-content').fadeIn('fast');
    });
  });
    		   		
  $('#loginModal').click(function(){			    			
    $('#signup-modal-content').fadeOut('fast', function(){
       $('#usremail').val('');  	
       $('#login-password').val('');  	
       $('#login-modal-content').fadeIn('fast');
    });
  });
    		
  $('#FPModal').click(function(){			   			
    $('#login-modal-content').fadeOut('fast', function(){
       $('#forgot-password-modal-content').fadeIn('fast');
    });
  });
    		
  $('#loginModal1').click(function(){			    			
    $('#forgot-password-modal-content').fadeOut('fast', function(){
       $('#login-modal-content').fadeIn('fast');
    });
  });

    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').fadeOut();
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').fadeIn();
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
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
        if(a == "cuslist" ){
                clearcus();
        }
        if(a == "promolist" ){
                clearpcod();
        }
        if(a == "contlist" ){
                clearcont();
        }
        if(a == "pnlist" ){
                clearpn();
        }
        $("."+a).fadeIn();
                    $("sidebar").removeClass("active");
                    $(".overlay").fadeOut();
    });
/*    
    if(vsearch.length > 0){
      oTable.fnFilter(vsearch);  
      oTable1.fnFilter(vsearch);  
      oTable5.fnFilter(vsearch);  
      /*oTable.fnDraw();*//*
    } 
    $('#prodstathistchart').on('click', function () {
         drawChartline();
    });
    $('#prodstatchart').on('click', function () {
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChartr);
    });
*/
    chksess(); 

})

function fnFormatDetails ( nTr ){
		var sOut;
		$.ajax({type:"POST",
		dataType:"json",
		url:path+"loadList.php",
		async:false,
		data: {t:"get_ppdet",ordid:vordid,ordit:vordit},
		//data: {t:"get_det",ordid:vordid,ordit:vordit},
		success:function(data){
		  sOut = data.vform;
		}
		});
		return sOut;
}

/* Event handler function */

function fnOpenClose ( oSettings ){
		$('td .img_details', oTable5.fnGetNodes() ).each( function () {
		$(this).click( function () {
		nTr = this.parentNode;
		if ( this.src.match('details_close') ){
		/* This row is already open - close it */
			this.src = "vendor/datatables/images/details_open.png";
			oTable5.fnClose( nTr );
		}else{
			$(".details").each(function(){
			$(this).remove()
		  });
		  $(".img_details").attr("src","vendor/datatables/images/details_open.png");
		  /* Open this row */
		  var myString = this.id;
		  var myarray = myString.split('-');
		  vordid = myarray[0];
		  vordit = myarray[1];
		  this.src = "vendor/datatables/images/details_close.png";
		  oTable5.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
		}
	  });
	});
}

function loginusr(){
        var usremail = $('#usremail').val();
        var usrpass = $('#login-password').val();
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'loginusr',usremail:usremail,usrpass:usrpass},
            success: function (resp)
            {
              if(resp.usrok == 'NO'){
                      alert('email or password does not exist.');
                      return false;
              }
              $('#page-wrapper').prop('class','ulogin');
              $('#usrlog').prop('class','nav navbar-top-links navbar-right');
              $('#usrlog').html('<li class="dropdown">'
                                +'<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>'
                                +'<ul class="dropdown-menu dropdown-user">'
                                +'<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>'
                                +'<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>'
                                +'<li class="divider"></li>'
                                +'<li><a href="javascript:void(0)" onclick="logout()"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>'
                                +'</ul>'
                                +'</li>');
             $('#email').val('');  	
             $('#login-password').val('');  	
             $('#sidebarCollapse').removeClass('nologin');
             $('#sidebarCollapse').addClass('ulogin');
             if(resp.rol == 1){
               $('#sidebar').removeClass('udsg');
               $('#sidebar').addClass('uadm');
               $('#mainadm').removeClass('udsg');
               $('#mainadm').addClass('uadm');
               $('#container').removeClass('udsg');
               $('#container').addClass('uadm');
               $('#container').show();
               $('#newcateg').removeClass('udsg');
               $('#newcateg').addClass('uadm');
               $('#divcateg').removeClass('udsg');
               $('#divcateg').addClass('uadm');
               $('#divporder').removeClass('uadm');
               $('#divporder').addClass('udsg');
               $('#ptdusr').html(resp.sassoc);
               $("#usrid").select2();
               vusrid=resp.sassoc;
               $('.categlist').show();
             }
/*
             if(resp.rol == 2){
               $('#sidebar').removeClass('uadm');
               $('#sidebar').addClass('udsg');
               $('#mainadm').removeClass('uadm');
               $('#mainadm').addClass('udsg');
               $('#preord').removeClass('uadm');
               $('#preord').addClass('udsg');
               $('#container').removeClass('udsg');
               $('#container').addClass('uadm');
               $('#container').show();
               $('#newrfq').removeClass('uadm');
               $('#newrfq').addClass('udsg');
               $('#neword').removeClass('uadm');
               $('#neword').addClass('udsg');
               $('#divorder').removeClass('uadm');
               $('#divorder').addClass('udsg');
               $('#divdsgr').removeClass('udsg');
               $('#divdsgr').addClass('uadm');
               $('#containerpord').removeClass('uadm');
               $('#containerpord').addClass('udsg');
               $('#containerpord').hide();
               $('#divporder').removeClass('uadm');
               $('#divporder').addClass('udsg');
             } 
             if(resp.rol == 3){
               $('#sidebar').removeClass('udsg');
               $('#sidebar').addClass('uadm');
               $('#mainadm').removeClass('uadm');
               $('#mainadm').addClass('udsg');
               $('#preord').removeClass('uadm');
               $('#preord').addClass('udsg');
               $('#production').removeClass('udsg');
               $('#production').addClass('uadm');
               $('#prod-status').removeClass('udsg');
               $('#prod-status').addClass('uadm');
               $('#container').removeClass('uadm');
               $('#container').addClass('udsg');
               $('#container').hide();
               $('#newrfq').removeClass('udsg');
               $('#newrfq').addClass('uadm');
               $('#neword').removeClass('udsg');
               $('#neword').addClass('uadm');
               $('#divorder').removeClass('udsg');
               $('#divorder').addClass('uadm');
               $('#divdsgr').removeClass('uadm');
               $('#divdsgr').addClass('udsg');
               $('#containerpord').removeClass('udsg');
               $('#containerpord').addClass('uadm');
               $('#containerpord').show();
               $('#containerparprod').removeClass('uadm');
               $('#containerparprod').addClass('udsg');
               $('#containerparprod').hide();
               $('#divporder').removeClass('udsg');
               $('#divporder').addClass('uadm');
               $('.pordlist').show();
             }
*/
             $('#login-signup-modal').modal('hide');
             $('#deptid').val(resp.deptid);
            }
        });
}

function reguser (){
        var usrname = $('#namereg').val();
        var usremail = $('#emailreg').val();
        var usrpass = $('#passwdreg').val();
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'reguser',usrname:usrname,usremail:usremail,usrpass:usrpass},
            success: function (resp)
            {
              if(resp.usrok == 'NO'){
                      alert('email or password does not exist.');
                      return false;
              }
              $('#page-wrapper').prop('class','ulogin');
              $('#usrlog').prop('class','nav navbar-top-links navbar-right');
              $('#usrlog').html('<li class="dropdown">'
                                +'<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>'
                                +'<ul class="dropdown-menu dropdown-user">'
                                +'<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>'
                                +'<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>'
                                +'<li class="divider"></li>'
                                +'<li><a href="javascript:void(0)" onclick="logout()"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>'
                                +'</ul>'
                                +'</li>');
             $('#email').val('');  	
             $('#login-password').val('');  	
             $('#namereg').val('');  	
             $('#emailreg').val('');  	
             $('#passwdreg').val('');  	
             $('#confirm-passwd').val('');  	
             $('#usremail').val('');  	
             $('#login-password').val('');  	
             $('#signup-modal-content').fadeOut('fast');
             $('#login-modal-content').fadeIn('fast');
             $('#login-signup-modal').modal('hide');
            }
        });
}

function logout (){
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'logout'},
            success: function (resp)
            {
              $('#page-wrapper').prop('class','nologin');
              $('#usrlog').prop('class','nav navbar-nav navbar-right');
              $('#usrlog').css('margin-right','20px');
              $('#usrlog').html('<li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-signup-modal">Login</a></li>');
             $('#email').val('');  	
             $('#login-password').val('');  	
             $('#namereg').val('');  	
             $('#emailreg').val('');  	
             $('#passwdreg').val('');  	
             $('#confirm-passwd').val('');  	
             $('#login-signup-modal').modal('hide');
             $('#sidebarCollapse').removeClass('ulogin');
             $('#sidebarCollapse').addClass('nologin');
             $('#signup-modal-content').fadeOut('fast');
             $('#login-modal-content').fadeIn('fast');
             $('#deptid').val('0');
            }
        });
}

function chksess(){
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'chksess'},
            success: function (resp)
            {
               if(resp.usrok == 'NO'){
                  $('#page-wrapper').prop('class','nologin');
                  $('#usrlog').prop('class','nav navbar-nav navbar-right');
                  $('#usrlog').css('margin-right','20px');
                  $('#usrlog').html('<li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-signup-modal">Login</a></li>');
                  $('#email').val('');  	
                  $('#login-password').val('');  	
                  $('#namereg').val('');  	
                  $('#emailreg').val('');  	
                  $('#passwdreg').val('');  	
                  $('#confirm-passwd').val('');  	
                  $('#login-signup-modal').modal('hide');
                  $('#sidebarCollapse').removeClass('ulogin');
                  $('#sidebarCollapse').addClass('nologin');
                  $('#signup-modal-content').fadeOut('fast');
                  $('#login-modal-content').fadeIn('fast');
               }
            }
        });
}

function showcateg()
{
        $('#container').html(vcontainer);
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showcateg'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
}



function savenewcateg()
{
 var catnom = $('#categnom').val();
 var catid = $('#categid').val();
 var rcatnom = document.getElementById('categnom');
 if(isEmpty(rcatnom, "Por Favor ingrese Nombre Categoria")){
           /*showaitalert();*/
           var dataitem = '';
           
           $('.sctritems').each(function () {
               var tr_val = $(this).attr('id');
               var tr_data = tr_val.split("-");
               var trid = tr_data[1];
               var vscnom = $('#scnom-'+trid).val();
               dataitem += vscnom+'|';
           });
           $.ajax({
               type: 'POST',
               dataType:"json",
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
                $(".menu li.active").removeClass("active");
                $(".menu #categlist").addClass("active");
                //ocultamos divisiones, mostramos la seleccionada
                $(".content").css("display", "none");
                clearcateg();
                $(".categlist").fadeIn();
                $('#msjalert').modal('hide');
              }
           });
        }
}

function editcateg(catid) {

        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'editcateg',catid:catid},
            success: function (resp)
            {
                $("#categid").val(catid);
                $("#categnom").val(resp.categdescr);
                $("#ctddel").html(resp.vcatdel);
                $("#sctbdy").html(resp.vresu);
                $("#sctdsave").html('<button id="addMoreOrder" class="btn btn-primary" type="button" onclick="saveupdcat()"><i class="fa fa-pencil-square-o"></i> Guardar</button>');
                dcmaxrow = resp.reng;
                $(".menu li.active").removeClass("active");
                $(".menu #newcateg").addClass("active");
                $(".menu #newcateg").html("Editar");
                $("#cathead").html("Editar Categoria");
                //ocultamos divisiones, mostramos la seleccionada
                $(".content").css("display", "none");
                $(".newcateg").fadeIn();
                window.scrollTo(0,0);
            }
        });
}

function saveupdcat()
{
 var catnom = $('#categnom').val();
 var catid = $('#categid').val();
 var rcatnom = document.getElementById('categnom');
 if(isEmpty(rcatnom, "Por Favor ingrese Nombre Categoria")){
           /*showaitalert();*/
           var dataitem = '';
           
           $('.sctritems').each(function () {
               var tr_val = $(this).attr('id');
               var tr_data = tr_val.split("-");
               var trid = tr_data[1];
               var vscnom = $('#scnom-'+trid).val();
               dataitem += trid+':'+vscnom+'|';
           });
           $.ajax({
               type: 'POST',
               dataType:"json",
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
                $(".menu li.active").removeClass("active");
                $(".menu #categlist").addClass("active");
                //ocultamos divisiones, mostramos la seleccionada
                $(".content").css("display", "none");
                clearcateg();
                $(".categlist").fadeIn();
                $('#msjalert').modal('hide');
              }
           });
        }
}


function clearcateg() {

        $('#categid').val('0');
        $('#categnom').val('');
        $("#ctddel").html('');
        $("#sctbdy").html('');
        $("#sctdsave").html('<button id="savecateg" class="btn btn-primary" type="button" onclick="savenewcateg()"><i class="fa fa-plus"></i> Guardar</button>');
        dcmaxrow = 0;
        $("#addrfqit").removeClass("rfqite");
        $(".menu #newcateg").html("Nueva");
        $("#cathead").html("Categoria Nueva");
}


function delecateg(catid)
{
        swal({
          title: "Esta seguro?",
          text: "¡No podrás recuperar esta Categoria!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, Borrala",
          cancelButtonText: "No, cancelar pf",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
                  
                        $.ajax({
                          method: "POST",
                        dataType:"json",
                          url: path+"loadList.php",
                          data: { t: "delecateg",catid:catid},
                          success:function(data){
                                oTable.fnDraw();
                                $(".menu li.active").removeClass("active");
                                $(".menu #categlist").addClass("active");
                                //ocultamos divisiones, mostramos la seleccionada
                                $(".content").css("display", "none");
                                clearcateg();
                                $(".categlist").fadeIn();
                                $('#msjalert').modal('hide');
                          }
                        }).done(function( msg ) {
                                console.log(msg);
                        });
                swal("Borrada!", "Esta Categoria fue BORRADA.", "success");
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
        // alert(iteration);
        //var itemval = '1';

        var tr = tbl.insertRow(-1);
        tr.id = 'sctr-' + newrow;
        tr.className = 'sctritems';

        $.ajax({
            type: 'POST',
            dataType:"json",
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
            dataType:"json",
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

function showaitalert() {
    var alertmsg = '<div><br><img src="images/ajax-loading.gif" width="130" height="130"><br><br></div>';
        $('#msjcontent').html(alertmsg);
        $('.commentsBox').css('width', '300px');
        $('.commentsBox').css('height', '190px');
        $('.commentsBox').css('padding', '10px');
       /* $('.commentsBox').css('background-color', '#000');*/
        $('.commentsBox').css('color', '#FFF');
        $('.commentsBox').css('font-size', '18px');
       /* $('.btnyesno').css('background-color', '#000');
        $('.btnyesno').css('color', '#FFF');*/
        var wh = Math.round(($( window ).height() * 0.30));
        $('.modal-content2').css('margin-top', wh + 'px');
        $('#msjalert').modal('show');
        
}
function showpdelalertu(row) {
    var alertmsg = '<div><br><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:30px;"></i><br><br>'
                  +'Do you wish to delete this item?<br><br>'
                  +'<button type="button" class="btn btn-default btnyesno" style="float:left" onclick="delitemu('+row+')">Yes</button>'
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

function isEmpty(elem, helperMsg){
  if(elem.value.length == 0){
    alert(helperMsg);
    elem.focus();
    return false;
  }else{
    return true;
  }
}

function isNumeric(elem, helperMsg){
  var numericExpression = /^[0-9]+$/;
  if(elem.value.match(numericExpression)){
    return true;
  }else{
    alert(helperMsg);
    elem.focus();
    return false;
  }
}

function isAlphabet(elem, helperMsg){
  var alphaExp = /^[a-zA-Z\s\d]+$/;
  if(elem.value.match(alphaExp)){
    return true;
  }else{
    alert(helperMsg);
    elem.focus();
    return false;
  }
}

function isAlphanumeric(elem, helperMsg){
  var alphaExp = /^[0-9a-zA-Z=;:?+-_@$%&()/"!#<>,\s\d]+$/;
  if(elem.value.match(alphaExp)){
    return true;
  }else{
    alert(helperMsg);
    elem.focus();
    return false;
  }
}

function lengthRestriction(elem, min, max){
  var uInput = elem.value;
  if(uInput.length >= min && uInput.length <= max){
    return true;
  }else{
    alert("Please enter between " +min+ " and " +max+ " characters");
    elem.focus();
    return false;
  }
}

function qtyRestriction(elem, helperMsg){
  var uInput = elem.value;
  if(uInput <= 100){
    return true;
  }else{
    alert(helperMsg);
    elem.focus();
    return false;
  }
}

function madeSelection(elem, helperMsg){
  if(elem.value == "Please Choose"){
    alert(helperMsg);
    elem.focus();
    return false;
  }else{
    return true;
  }
}

function emailValidator(elem, helperMsg){
  var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
  if(elem.value.match(emailExp)){
    return true;
  }else{
    alert(helperMsg);
    elem.focus();
    return false;
  }
}
