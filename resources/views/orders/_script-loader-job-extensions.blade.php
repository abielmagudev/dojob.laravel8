<script>
const jobExtensions = {
    helpers: {
        extensionsJsUrl: "<?= url('assets/xjs') ?>",
        getExtensionJsUrl: function (extension_js_name) {
            return this.extensionsJsUrl + '/' + extension_js_name
        }
    },
    spinner: {
        element: document.querySelector('#jobExtensions > #spinner'),
        show: function () {
            this.element.classList.replace('d-none', 'd-block')
        },
        hide: function () {
            this.element.classList.replace('d-block','d-none')
        }
    },
    container: {
        element: document.querySelector('#jobExtensions > #container'),
        draw: function (buffered) {
            buffered.scripts.forEach( function (script) {
                document.body.appendChild(script)
            })

            this.element.innerHTML = buffered.templates.reverse().join('<hr class="mt-3 mb-4">')
        },
        clean: function () {
            this.element.empty
        },
        show: function () {
            this.element.classList.replace('d-none', 'd-block')
        },
        hide: function () {
            this.element.classList.replace('d-block', 'd-none')
        },
    },
    load: async function (url) {
        this.spinner.show()

        let extensions = await this.request(url)

        if(extensions != undefined && extensions.length > 0 )
        {
            let buffered = this.buffer(extensions)
            this.container.draw(buffered)
            this.container.show()
        }

        this.spinner.hide()
    },
    request: async function (route) {
        let response = await fetch(route)
        let json = await response.json()
        return json.templates
    },
    buffer: function (extensions) {
        let helpers = this.helpers
        let buffering = {
            templates: [],
            scripts: []
        }

        extensions.forEach(function (extension) {
            buffering.templates.push(extension.template)

            if( extension.script )
            {
                let script_source = helpers.getExtensionJsUrl(extension.script);

                // Remove loaded script to reload them again and it works
                if( script_loaded = document.querySelector(`script[src="${script_source}"]`) )
                    script_loaded.remove()

                let script = document.createElement('script')
                script.src = script_source
                script.async = true
                script.defer = true
                buffering.scripts.push(script)
            }
        })

        return buffering;
    },
    reset: function () {
        this.container.clean()
        this.container.hide()
    }
}
</script>
