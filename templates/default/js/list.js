list = {
	links:'#mvcnews-pagination a',	
	init: function() {
		this.addEventToPaginationLinks();		
	},
	
	addEventToPaginationLinks: function() {		
			//add events to pagination
			$(this.links).click( function (e) {				
				 list.paginationClickEvent(this);
				 return false;
			});
	},
	
	paginationClickEvent: function(element) {
		//$(list.elementForEffectId).fadeOut("slow");		
		var url = $(element).parents('.ajax-linkset').find('.ajax-url').attr('href');
		//######Version 1 - calling .php directly
			//$.php(url);
		
		//#######Version 2 - building own call and jandly return with jquery.php:
		 // do an ajax post request
        jQuery.ajax({          
           url: url,
           // JSON
           type: "POST",
           dataType : "json",
           
           /* Handlers */           
           success: function(data, textStatus) {        	   
               php.success(data, textStatus);
               list.addEventToPaginationLinks();
               return ;
           },
           // Handle the error event
           error: function (xmlEr, typeEr, except) {
               return php.error(xmlEr, typeEr, except);                  
           },
        })
			
		//######Version 3 - without jquery.php plugin
	        /*
			//ajax:
			$.get(url, 
				{},
				function(html) {
					list.elementForReplaceObject.html(html);
					
					//$(this.elementForEffectId).fadeIn("show");
					//$(list.elementForEffectId).css('background-color','yellow');
					$(list.elementForEffectId).stop().animate({ backgroundColor: "#f6f6f6" }, 'fast');
	
				});
			*/
		return false;
	}
}