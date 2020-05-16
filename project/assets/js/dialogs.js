import Dialog, { setDefaults } from 'a11y-dialog-component';

setDefaults({
    documentSelector: 'body',
    documentDisabledClass: 'modal-open',
    backdropSelector: '.modal-backdrop',
});

const tvShowSeasonsDialog = new Dialog('#tvshow-seasons-modal', {
    openingSelector: '.js-dialog-open',
    closingSelector: '.js-dialog-close',
    labelledby: 'modal-title',
    onOpen: (dialog, openner) => {
        fetch(openner.dataset.url)
            .then((response) => {
                return response.text()
            }).then((html) => {
            dialog.querySelector('.modal-content').innerHTML = html;
            dialog.classList.add('show')
            dialog.style.display = 'block'
            document.querySelector('body').insertAdjacentHTML('beforeend', '<div class="modal-backdrop show"></div>')
        })
    },
    onClose: (dialog) => {
        dialog.classList.remove('show')
        dialog.style.display = 'none'
        document.querySelector('body').querySelector('.modal-backdrop').remove()
    }
});
