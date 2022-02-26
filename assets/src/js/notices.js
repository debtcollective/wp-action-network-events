document.addEventListener("DOMContentLoaded", () => {
    const data = wpANENoticesData;
    const syncButton = document.getElementById('wp-action-network-events-sync-submit');
    const noticeContainer = document.getElementById( data.ontainer_id );

    const onClick = (event) => {
        event.preventDefault();
        sendRequest(data);
    }
 
    const sendRequest = (data) => {
        const params = {
            action: data.action,
            nonce: data.nonce
        }

        let query = new URLSearchParams( params ).toString();

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
                console.log(data)
            })

    }

    if (syncButton && data) {
        syncButton.addEventListener('click', onClick);
    }

});