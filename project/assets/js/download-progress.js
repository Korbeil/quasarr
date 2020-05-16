const badgeClasses = {
    Downloading: 'primary',
    Downloaded: 'success',
    Paused: 'warning'
}

const components = document.querySelectorAll('[data-component="download-progress"]')
components.forEach((component) => {
    const status = component.dataset.status

    if (status === 'Missing') {
        return;
    }

    const statusUrl = component.dataset.statusUrl
    const resumeUrl = component.dataset.resumeUrl
    const pauseUrl = component.dataset.pauseUrl
    const hash = component.dataset.hash

    setInterval(function () {
        fetch(statusUrl)
            .then((response) => response.json())
            .then((data) => {
                const progressBar = document.querySelector(`#progress-${hash}`)
                const titleMovieBadge = document.querySelector(`#title-badge-${hash}`)

                progressBar.style.width = data.progress + '%'
                progressBar.setAttribute('aria-valuenow', data.progress)
                progressBar.innerText = data.progress + '%'
                progressBar.classList.remove('bg-warning')
                progressBar.classList.remove('bg-primary')
                progressBar.classList.remove('bg-success')
                progressBar.classList.add(`bg-${badgeClasses[data.status]}`)

                titleMovieBadge.innerText = data.status;
                titleMovieBadge.classList.remove('badge-warning')
                titleMovieBadge.classList.remove('badge-primary')
                titleMovieBadge.classList.remove('badge-success')
                titleMovieBadge.classList.add(`badge-${badgeClasses[data.status]}`)
            })
    }, 1000)

    document.querySelector('#resume-torrent').addEventListener('click', () => fetch(resumeUrl))
    document.querySelector('#pause-torrent').addEventListener('click', () => fetch(pauseUrl))
});
