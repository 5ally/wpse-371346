jQuery( function ( $ ) {

    $('#my-form').submit(function (e) {

    	e.preventDefault();

    

    	var data = new FormData( this ); 

    

    	data.append( 'rtype', 'create' ); // add extra param NOT in the form

    

    	$.ajax({

    

    		url: MY_PLUGIN.root + 'my-plugin/v1/foo',

    		data: data, //$.param(data),

    		processData: false,

    		contentType: false,

    		method: 'POST', // the request method should be POST

    		beforeSend: function ( xhr ) {

    			xhr.setRequestHeader( 'X-WP-Nonce', MY_PLUGIN.nonce );

    		},

    		success: function ( data ) {

    			$( '#my-div' )

    	    	    	    	.html( 'foo: ' + data.foo )

    	    	    	    	.append( '<br>file: ' + data.file );

    		},

    	});

    });

} );

