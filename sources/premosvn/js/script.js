$(document).ready(function(){
		service.makeDir();
        service.getService();
    });
var service = {
	path:'_serv/',
	sHtml:'',
	status:'false',
	makeDir:function(){
		var html = '';
        $.ajax({
            method: "POST",
			url: service.path+"insertServer.php",
            data: {t:'makedir'}
        }).done(function( msg ) {
        	console.log('msg:'+msg);
        });
	},
    getService:function(){
    	$("body").html("Please wait while the system is uploaded, you'll be redirected to main page in few seconds");
    	var html = '';
        $.ajax({
            method: "GET",
            url: "https://vendor.zazzle.com/v100/api.aspx?method=listneworders&vendorid=shark_ssw&hash=220ff59bf42d93fcacbd7576877f201a",
            //url: "127.0.0.1/servicio/xml.xml",
            data: {}
        }).done(function( msg ) {
        	service.uploadXml(msg);
        });
    },
    uploadXml:function(xml){

    	var orderId = 0;
    	xmlDoc = $.parseXML( xml ),
		$xml = $( xmlDoc ),
		//$Order = $xml.find("Order");
		$(xmlDoc).find('Order').each(function(){
			var $Order = $(this);
			orderId = $Order.find("OrderId").first().text();
    	});
    	$.ajax({
            method: "post",
            async: "false",
            url: service.path+"loadXml.php",
            data: {sorderId:orderId,sXML:xml}
        }).done(function( msg ) {
        	if(msg=='ok'){
        		service.uploadNodes(xml);
        	}
        });
    },
    uploadNodes:function(msg){
		xmlDoc = $.parseXML( msg ),
		$xml = $( xmlDoc ),
		//$Order = $xml.find("Order");
		$(xmlDoc).find('Order').each(function() {
			var $Order = $(this);
			var OrderIdGeneral=0;
			orderId = $Order.find("order>OrderId").text();
			OrderIdGeneral = orderId;
			//console.log(orderId);
			OrderDate = $Order.find("order>OrderDate").text();
			OrderType = $Order.find("order>OrderType").text();
			DeliveryMethod = $Order.find("order>DeliveryMethod").text();
			Priority = $Order.find("order>Priority").text();
			Currency = $Order.find("order>Currency").text();
			Status = $Order.find("order>Status").text();
			Attributes = $Order.find("order>Attributes").text();

			html = '<table border="1">';
			html += '<tr><th colspan="8"><h2>Item: '+orderId+' </h2></td></tr>';
			html += '<tr><th>orderId</th><th>OrderDate</th><th>OrderType</th><th>DeliveryMethod</th><th>Priority</th><th>Currency</th><th>Status</th><th>Attributes</th></tr>';
			html += '<tr><td>'+orderId+'</td><td>'+OrderDate+'</td><td>'+OrderType+'</td><td>'+DeliveryMethod+'</td><td>'+Priority+'</td><td>'+Currency+'</td><td>'+Status+'</td><td>'+Attributes+'</td></tr>';
			
			Address1 = $Order.find("order>ShippingAddress>Address1").text();
			Address2 = $Order.find("order>ShippingAddress>Address2").text();
			Address3 = $Order.find("order>ShippingAddress>Address3").text();
			Name = $Order.find("order>ShippingAddress>Name").text();
			Name2  = $Order.find("order>ShippingAddress>Name2").text();
			City =  $Order.find("order>ShippingAddress>City").text();
			State =  $Order.find("order>ShippingAddress>State").text();
			Country =  $Order.find("order>ShippingAddress>Country").text();
			CountryCode =  $Order.find("order>ShippingAddress>CountryCode").text();
			Zip =  $Order.find("order>ShippingAddress>Zip").text();
			Phone = $Order.find("order>ShippingAddress>Phone").text();
			Email = $Order.find("order>ShippingAddress>Email").text();
			$.ajax({
				method: "POST",
				url: service.path+"insertServer.php",
				async: "false",
				data: {t:1, sorderId: orderId, sOrderDate: OrderDate,
						sOrderType:OrderType,sDeliveryMethod:DeliveryMethod,sPriority:Priority,
						sCurrency:Currency,sStatus:Status,sAttributes:Attributes,
						aAddress1:Address1,sAddress2:Address2,sAddress3:Address3,sName:Name,
						sName2:Name2,sCity:City,sState:State,sCountry:Country,sCountryCode:CountryCode,
						sZip:Zip,sPhone:Phone,sEmail:Email}
			}).done(function( msg ) {
				
				if(msg =='ok'){
					service.getHash(OrderIdGeneral);
					service.status=true;
				}else{
					service.status=false;
				}
			});
			$($Order).find('order>LineItems>LineItem').each(function(idx){

				LineItemId = $Order.find("order>LineItems>LineItem>LineItemId").text();
				OrderId = $Order.find("order>LineItems>LineItem>OrderId").first().text();

				LineItemType = $Order.find("order>LineItems>LineItem>LineItemType").text();
				Quantity = $Order.find("order>LineItems>LineItem>Quantity").map(function(){return $(this).text()}).get();
				if(Quantity.length > 0){
					Quantity = Quantity[0];
				}
				//Description = $Order.find("order>LineItems>LineItem>Description").text();
				Description = $($Order).find('order>LineItems>LineItem>Description').map(function(){return $(this).text()}).get();
				Description = Description[idx];
				//Attributes = $Order.find("order>LineItems>LineItem>Attributes").text();
				Attributes = $($Order).find('order>LineItems>LineItem>Attributes').map(function(){return $(this).text()}).get();
				Attributes = Attributes[idx];

				html += '<tr><td>'+LineItemId+'</td><td>'+OrderId+'</td><td>'+LineItemType+'</td><td align="center">'+Quantity+'</td><td colspan="2">'+Description+'</td><td colspan="2">'+Attributes+'</td></tr>';
				Price = $Order.find("order>LineItems>LineItem>Price").text();
				ProductId = $Order.find("order>LineItems>LineItem>ProductId").text();
				
				$.ajax({
					method: "POST",
					url: service.path+"insertServer.php",
					async: "false",
					data: {t:2,sLineItemId:LineItemId,sOrderId:OrderId,sLineItemType:LineItemType,sQuantity:Quantity[0],sDescription:Description,sAttributes:Attributes,sPrice:Price,sProductId:ProductId}
				}).done(function( msg ) {
					if(msg=='ok'){
						service.status=true;
					}else{
						service.status=false;
						console.log(msg);
					}
				});

			});
			
			//Images
			$($Order).find('order>LineItems>LineItem>PrintFiles>PrintFile').each(function(idx){
				var ztype,zutl,zDescription = '';
				qtype = $($Order).find('order>LineItems>LineItem>PrintFiles>PrintFile>Type').map(function(){return $(this).text()}).get();
				qurl = $($Order).find('order>LineItems>LineItem>PrintFiles>PrintFile>Url').map(function(){return $(this).text()}).get();
				qDescription = $($Order).find('order>LineItems>LineItem>PrintFiles>PrintFile>Description').map(function(){return $(this).text()}).get();
				for(x=0;x<qtype.length;x++){
					ztype=qtype[x];
				}
				for(x=0;x<qurl.length;x++){
					zurl= qurl[x];
				}
				for(x=0;x<qDescription.length;x++){
					zDescription=qDescription[x];
				}

				$.ajax({
					method: "POST",
					url: service.path+"insertServer.php",
					async: "false",
					data: {t:3,sAttributes:Attributes,sProductId:ProductId,sOrderId:orderId,stype:ztype,surl:zurl,sDescription:zDescription,sPreview:0}
				}).done(function( msg ) {
					if(msg=='ok'){
						service.status=true;
					}else{
						service.status=false;
						console.log(msg);					
					}
				});
			});
			//Previews
			$($Order).find('order>LineItems>LineItem>Previews>PreviewFile').each(function(idx){
				var xtype,xutl,xDescription = '';
				wtype = $($Order).find('order>LineItems>LineItem>Previews>PreviewFile>Type').map(function(){return $(this).text()}).get();
				wurl = $($Order).find('order>LineItems>LineItem>Previews>PreviewFile>Url').map(function(){return $(this).text()}).get();
				wDescription = $($Order).find('order>LineItems>LineItem>Previews>PreviewFile>Description').map(function(){return $(this).text()}).get();
				for(x=0;x<wtype.length;x++){
					xtype=wtype[x];
				}
				for(x=0;x<wurl.length;x++){
					xurl=wurl[x];
				}
				for(x=0;x<wDescription.length;x++){
					xDescription=wDescription[x];
				}
				$.ajax({
					method: "POST",
					url: service.path+"insertServer.php",
					async: "false",
					data: {t:3,sAttributes:Attributes,sProductId:ProductId,sOrderId:orderId,stype:xtype,surl:xurl,sDescription:xDescription,sPreview:1,samoutImages:wurl.length}
				}).done(function( msg ) {
					if(msg=='ok'){
						service.status=true;
					}else{
						service.status=false;
						console.log(msg);
					}
				});
			});
			//Products
			$($Order).find('order>Products>Product').each(function(idx){
				ProductId = $($Order).find('order>Products>Product>ProductId').map(function(){return $(this).text()}).get();
				
				for(x=0;x<ProductId.length;x++){
					gProductId = ProductId[x];
				}
				$.ajax({
					method: "POST",
					url: service.path+"insertServer.php",
					async: "false",
					data: {t:4,sProductId:gProductId,sOrderId:orderId}
				}).done(function( msg ) {
					if(msg=='ok'){
						service.status=true;
					}else{
						alert('tipo4');
						service.status=false;
						console.log(msg);
					}
				});
				
			});

			$($Order).find('order>PackingSheet>Page').each(function(idx){
				PageNumber = $Order.find("order>PackingSheet>Page>PageNumber").text();
				etype = $($Order).find('order>PackingSheet>Page>Front>Type').map(function(){return $(this).text()}).get();
				eDescription = $($Order).find('order>PackingSheet>Page>Front>Description').map(function(){return $(this).text()}).get();
				eUrl = $($Order).find('order>PackingSheet>Page>Front>Url').map(function(){return $(this).text()}).get();
				for(x=0;x<etype.length;x++){
					ytype = etype[x];
				}
				for(x=0;x<eUrl.length;x++){
					yurl = eUrl[x];
				}
				for(x=0;x<eDescription.length;x++){
					yDescription = eDescription[x];
				}
				$.ajax({
					method: "POST",
					url: service.path+"insertServer.php",
					async: "false",
					data: {t:5,sOrderId:orderId,stype:ytype,surl:yurl,sDescription:yDescription,sPageNumber:PageNumber}
				}).done(function( msg ) {
					if(msg=='ok'){
						service.status = true;
					}else{
						service.status = false;
						console.log(msg);
					}
				});
			});
		});
		
    },
    getHash:function(orderId){
    	var method = 'ackorder';
    	type= 'new';
		$.ajax({
            method: "POST",
            url: service.path+"loadList.php",
            data: {t:'ackOrder',sorderId:orderId,stype:type}
        }).done(function( msg ) {
        	service.ackOrder(orderId,msg);
        });
    },
    ackOrder:function(orderId,hash){
    	var url= 'https://vendor.zazzle.com/v100/api.aspx?method='+method+'&vendorid=shark_ssw&orderid='+orderId+'&type='+type+'&action=accept&hash='+hash;
    	var method = 'ackorder';
    	var type= 'new';
		$.ajax({
            method: "GET",
            url: 'https://vendor.zazzle.com/v100/api.aspx?method='+method+'&vendorid=shark_ssw&orderid='+orderId+'&type='+type+'&action=accept&hash='+hash,
            data: {}
        }).done(function( msg ) {
        	service.uploadXMLResponse(msg,method,orderId);
        });
    },
    makeTable:function(html){
    	html += '</table>';
    	$("#divContent").html(html);
    	$('#Table').bdt();
    },
    uploadXMLResponse:function(xmlResponse,method,orderId){
		$.ajax({
            method: "post",
            async: "false",
            url: service.path+"insertServer.php",
            data: {t:'xmlResponse',sOrderId:orderId,sxmlResponse:xmlResponse,smethod:method}
        }).done(function( msg ) {
        	if(msg!='ok'){
				console.log('Mensaje:'+msg);
			}
        });
    }
}