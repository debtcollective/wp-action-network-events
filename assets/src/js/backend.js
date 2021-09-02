document.addEventListener( "DOMContentLoaded", () => {
    const buttonEl = document.getElementById( 'wp-action-network-events-sync-button' );
    const nonce = document.getElementById( 'wp_action_network_events_sync_nonce' );
    const data = wpANEData;

    const onClick = ( event ) => {
        event.preventDefault();
        sendRequest( data );
    }

    const sendRequest = ( props ) => {
        const params = {
            action: data.action,
        }

        let query = new URLSearchParams( params ).toString();

        fetch( data.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: new Headers( { 'Content-Type': 'application/x-www-form-urlencoded' } ),
            body: query
          } )
        .then( response => response.json() )
        .then( data => console.log( data ) );

    }

    if( buttonEl && data && nonce ) {
        buttonEl.addEventListener( 'click', onClick );
    }

} );