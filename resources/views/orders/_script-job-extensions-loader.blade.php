<script>
const extensionsJob = {
    spinner: {
        element: document.querySelector('#extensionsJob > #extensionsJobSpinner'),
        show: function () {
            this.element.classList.replace('d-none', 'd-block')
        },
        hide: function () {
            this.element.classList.replace('d-block','d-none')
        }
    },
    container: {
        element: document.querySelector('#extensionsJob > #extensionsJobContainer'),
        show: function () {
            this.element.classList.replace('d-none', 'd-block')
        },
        hide: function () {
            this.element.classList.replace('d-block', 'd-none')
        },
        clean: function () {
            this.element.empty
        },
        draw: function (buffer) {
            let body_cache = document.body

            buffer.scripts.forEach( function (script) {
                body_cache.appendChild(script)
            })

            this.element.innerHTML = buffer.templates.join(
                (extensionsJob.settings.custom.divider ?? extensionsJob.settings.default.divider)
            )
        }
    },
    settings: {
        custom: {

        },
        default: {
            action: 'create',
            divider: '<hr class="mt-3 mb-4">'
        }
    },
    setup: function (settings) {
        this.settings.custom = settings
    },
    load: async function (job_id) {
        this.spinner.show()

        let templates = await this.request.get(job_id)
        
        if(templates != undefined && templates.length > 0 )
        {
            this.container.draw(
                this.buffer(templates)
            )

            this.container.show()
        }

        this.spinner.hide()
    },
    request: {
        route: "<?= route('extensions-job.ajax', ['job' => 'job?', 'action' => 'action?', 'order' => 'order?']) ?>",
        url: function (job_id) {

            let parameters = {
                job: job_id,
                action: extensionsJob.settings.custom.action ?? extensionsJob.settings.default.action,
                order: extensionsJob.settings.custom.order ?? ''
            }            

            return this.route
                    .replace('job?', parameters.job)
                    .replace('action?', parameters.action)
                    .replace('order?', parameters.order)
        },
        get: async function (job_id) {
            let url = this.url(job_id);

            let response = await fetch(url)

            let json = await response.json()
            
            return json.templates        
        }
    },
    buffer: function (templates) {

        let cache = {
            templates: [],
            scripts: []
        }

        templates.forEach(function (template) {

            cache.templates.push(template.view)

            if( template.script && template.script != null )
            {
                let templateScriptSource = "<?= url('assets/xjs') ?>" + '/' + template.script;

                // Remove loaded(exists) script to reload them again and it works
                if( scriptLoaded = document.querySelector(`script[src="${templateScriptSource}"]`) )
                {
                    scriptLoaded.remove()
                }

                // Create new script element to load
                let script = document.createElement('script')
                script.src = templateScriptSource
                script.async = true
                script.defer = true

                cache.scripts.push(script)
            }
        })

        return cache;
    },
    reset: function () {
        this.container.clean()
        this.container.hide()
        this.spinner.hide()
    }
}
</script>
