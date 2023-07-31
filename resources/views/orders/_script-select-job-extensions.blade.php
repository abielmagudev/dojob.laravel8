<script>
const selectJob = {
    element: document.getElementById('selectJob'),
    route: "<?= route('orders-job-extensions.create', 'id?') ?>",
    listen: function () {
        let route = this.route

        this.element.addEventListener('change', function () {
            jobExtensions.reset();
            
            let option = this.options[this.selectedIndex]

            if( option.dataset.hasExtensions > 0 ) {
                let url = route.replace('id?', this.value)
                jobExtensions.load(url)
            }
        })
    }
}
selectJob.listen()
</script>

@if( old('job') )
<script>selectJob.element.dispatchEvent( new Event('change') )</script>
@endif
