      
$(document).ready(function() {

   formid = $('#formid').val();
   xurg='';
   xdshd='';

    num_seconds = 0;
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
    chksess(); 

})

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
        //oTable = null;
        oTable = undefined;
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

function showciva()
{
        $('#container').html(vcontainer);
        //oTable = null;
        oTable = undefined;
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showciva'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
}

function showciva()
{
        $('#container').html(vcontainer);
        oTable = undefined;
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showciva'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
}

function showprov()
{
        $('#container').html(vcontainer);
        oTable = undefined;
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showprov'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#vicond').html(response.vcondiva);
                $('#viloc').html(response.vloc);
                vcondiva=response.vcondiva;
                vloc=response.vloc;
                $("#vcondiva").select2();
                $("#vlocid").select2();
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
}

function showartic()
{
        $('#container').html(vcontainer);
        oTable = undefined;
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showartic'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#vcateg').html(response.vcateg);
                $('#vsubcat').html(response.vsubcat);
                $('#vicateg').html(response.vicateg);
                $('#visubcat').html(response.visubcat);
                $('#viunidcpra').html(response.viunidcpra);
                $('#vistkunid').html(response.vistkunid);
                vcateg=response.vcateg;
                vsubcat=response.vsubcat;
                vicateg=response.vicateg;
                visubcat=response.visubcat;
                viunidcpra=response.viunidcpra;
                vistkunid=response.vistkunid;
                $("#qcateg").select2();
                $("#qsubcat").select2();
                $("#icateg").select2();
                $("#isubcat").select2();
                $("#iunidcpra").select2();
                $("#istkunid").select2();
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
}

function showinventario()
{
        $('#container').html(vcontainer);
        oTable = undefined;
        $.ajax({
            type: 'POST',
            dataType:"json",
            url: '_serv/loadList.php',
            async:false,
            data: {t:'showinventario'},
            success: function (response)
            {
                $('#container').html(response.vform);
                $('#vcateg').html(response.vcateg);
                $('#vsubcat').html(response.vsubcat);
                vcateg=response.vcateg;
                vsubcat=response.vsubcat;
                $("#qcateg").select2();
                $("#qsubcat").select2();
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            }
        });
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
