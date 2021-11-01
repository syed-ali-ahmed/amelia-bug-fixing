( function( $, $w, $d ){
    window.beforeConfirmBookingLoaded = function( appointment, service, provider, location ){
        let module;
        let vue_loader_i = setInterval( function(){
            module = $( '.am-confirm-booking-form' );
            if ( module.length ) {
                console.log( 'Field loaded' )
                $.ajax( {
                    url: abf_object.ajaxurl,
                    method: 'POST',
                    data: {
                        action: 'abf_ajax',
                        method: 'fill_fields_automatically',
                        data: {
                            appointment: appointment,
                            service: service,
                            provider: provider,
                            location: location,
                        }
                    },
                    success:function( response ){

                    },
                    error:function( response ){
                        let fields,
                            counter,
                            __counter = 3;
                        response = response.responseJSON;
                        fields   = response.data.data;
                        counter  = Object.keys( fields ).length;
                        console.log( fields )

                        for ( let i = 0; counter > i ;i++) {
                            let mod = $( '.el-select-dropdown__item' );
                            let _counter = mod.length;

                            for (let x = 0; _counter > x ; x++) {
                                if ( $( mod[ x ] ).text() == fields[ __counter ] ) {
                                    $( mod[ x ] ).click();
                                }
                            }
                            __counter++;
                        }
                    }
                } );
                clearInterval( vue_loader_i );
            }
        }, 1000 );
    }

    let vue_loader_ii = setInterval( function(){
        if ( $( '.am-appointment-header' ).length ) {
            console.log( 'Am Appointment Header loaded' )
            let appointment_header = $( '.am-appointment-header' ),
                children           = $( appointment_header ).children(),
                cp_head            = children[ children.length -1 ];
            $( cp_head ).css( 'display', 'none' );
            clearInterval( vue_loader_ii );
        }
    }, 1000 );

    let vue_loader_iii = setInterval( function(){
        if ( $( '.am-appointment-body' ).length ) {
            console.log( 'Am Appointment Header loaded' )
            let appointment_header = $( '.am-appointment-body' ),
                children           = $( appointment_header ).children(),
                cp_head            = children[ children.length -1 ];
            $( cp_head ).css( 'display', 'none' );
            clearInterval( vue_loader_iii );
        }
    }, 1000 );
}( jQuery, window, document ) );