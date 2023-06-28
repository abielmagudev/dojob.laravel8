<script>
const selectJob = {
    element: document.getElementById('selectJob'),
    listen: function () {
        this.element.addEventListener('change', function () {
            extensionsContainer.reset()

            let option = this.options[this.selectedIndex]

            if( option.dataset.hasExtensions > 0 )
                extensionsContainer.add(this.value)
        })
    }
}

const extensionsContainer = {
    element: document.getElementById('extensionsContainer'),
    spinner: {
        element: document.getElementById('extensionsLoadingSpinner'),
        show: function () {
            this.element.classList.replace('d-none', 'd-block')
        },
        hide: function () {
            this.element.classList.replace('d-block','d-none')
        }
    },
    add: async function (job_id) {
        this.spinner.show()

        let extensions = await this.request(job_id);
        if( extensions.length == 0 )
            return;
        
        let domain_xjs = "<?= url('assets/xjs') ?>/";

        let templates_cache = [];
        extensions.forEach(function (extension) {
            templates_cache.push(extension.template)
            
            if( extension.script )
            {
                if( script_exists = document.querySelector(`script[src="${domain_xjs + extension.script}"]`) )
                    script_exists.remove()

                let script = document.createElement('script')
                script.src = domain_xjs + extension.script
                script.async = true
                script.defer = true
                document.body.appendChild(script)
            }
        })

        this.element.innerHTML = templates_cache.reverse().join('<hr class="mt-3 mb-4">')
        this.spinner.hide()
        this.show()
    },
    request: async function (job_id) {
        let response = await fetch("<?= route('extensions.loader') ?>", {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "<?= csrf_token() ?>"
            },
            body: JSON.stringify({
                job: job_id,
                method: 'create'
            })
        })

        let json = await response.json()

        return json.templates;
    },
    show: function () {
        this.element.classList.replace('d-none', 'd-block')
    },
    hide: function () {
        this.element.classList.replace('d-block', 'd-none')
    },
    clean: function () {
        this.element.empty;
    },
    reset: function () {
        this.clean()
        this.hide()
    }
}

selectJob.listen()

</script>
