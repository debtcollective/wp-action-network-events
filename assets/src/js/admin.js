import '../scss/admin.scss';

document.addEventListener("DOMContentLoaded", () => {
    const data = wpANEData;
    const syncButton = document.getElementById('wp-action-network-events-sync-submit');
    const importButton = document.getElementById('wp-action-network-events-sync-submit-clean');
    const clearCacheButton = document.getElementById('wp-action-network-events-clear-cache');
    const nonce = document.getElementById('wp_action_network_events_sync_nonce');
    const noticeContainer = document.getElementById('sync-notice-container');

    const errorNotice = '<div class="notice notice-error"><p>%s</p></div>';
    const successNotice = '<div class="notice notice-success is-dismissible"><p>Successfully completed at %s</p></div>';
    const infoNotice = '<div class="notice notice-info is-dismissible"><p>%s</p></div>';
    const warningNotice = '<div class="notice notice-warning is-dismissible"><p>%s</p></div>';

    const onClick = (event) => {
        event.preventDefault();
        let action = 'wp-action-network-events-sync-submit-clean' === event.target.id ? data.action + '_clean' : data.action;
        sendRequest(action);
    }

    const sendRequest = (action) => {
        const params = {
            action: action,
            nonce: data.nonce
        }

        let query = new URLSearchParams(params).toString();

        fetch(data.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' }),
            body: query
        })
        .then(response =>
            response.json()
        )
        .then(data => {
            console.log(data);
            let message = successNotice.replace('%s', data.finish);
            noticeContainer.insertAdjacentHTML('afterbegin', message);
        })
        .catch((error) => {
            console.error('Error:', error);
            let message = successNotice.replace('%s', JSON.stringify( error ));
            noticeContainer.insertAdjacentHTML('afterbegin', errorNotice);
        });


    }

    const clearCache = (event) => {
        event.preventDefault();

        const params = {
            action: data.actionClearCache,
        }

        let query = new URLSearchParams(params).toString();

        fetch(data.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' }),
            body: query
        })
        .then(response =>
            response.json()
        )
        .then(data => {
            // console.log(data);
            clearCacheMessage( data.data, 'success' );
        })
        .catch((error) => {
            console.error('Error:', error);
            clearCacheMessage( 'Cache Not Cleared', 'error' );
        });

    }

    const clearCacheMessage = ( message, status ) => {
        const el = document.createElement("span");
        const className = 'notice-' + status;
        el.classList.add( 'notice' );
        el.classList.add( className );
        const text = document.createTextNode( message );
        el.appendChild( text );
        clearCacheButton.replaceWith(el);
    }

    if (syncButton && data && nonce) {
        syncButton.addEventListener('click', onClick);
    }

    if (importButton && data && nonce) {
        importButton.addEventListener('click', onClick);
    }

    if (clearCacheButton) {
        clearCacheButton.addEventListener('click', clearCache);
    }

});