var Sender = {
	send: function(url, params, funct){
		$.post('./Views/Responses/'+url+'.php', params, function(data, textStatus, xhr) {
			return funct(data, textStatus, xhr)
		},'json');
	}
}