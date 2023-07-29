<?php
$scriptSettings = (object) [
    'csrf_token' => csrf_token(),
    'fetch_route' => route('job_extensions'),
    'extensionsjs_url' => url('assets/xjs'),
    'request_method' => $method,
    'order_id' => isset($order) ? $order : 'null',
    'extra' => isset($extra) ? json_encode($extra) : json_encode([]),
]; 
?>
<script>
const jobExtensionsContainer = {
    element: document.getElementById('jobExtensionsContainer'),
    spinner: {
        element: document.getElementById('loadingMessage'),
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
        if( extensions == undefined || extensions.length == 0 )
        {
            this.spinner.hide()
            return;
        }
        
        let templates_cache = [];
        extensions.forEach(function (extension) {
            templates_cache.push(extension.template)
            
            if( extension.script )
            {
                let script_source = "<?= $scriptSettings->extensionsjs_url ?>/" + extension.script;

                if( script_exists = document.querySelector(`script[src="${script_source}"]`) )
                    script_exists.remove()

                let script = document.createElement('script')
                script.src = script_source
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
        let response = await fetch("<?= $scriptSettings->fetch_route ?>", {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?= $scriptSettings->csrf_token ?>'
            },
            body: JSON.stringify({
                job: job_id,
                method: '<?= $scriptSettings->request_method ?>',
                order: <?= $scriptSettings->order_id ?>,
                extra: <?= $scriptSettings->extra ?>
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
</script>