<script>
const selectJob = {
    element: document.getElementById('selectJob'),
    exists: function () {
        return this.element != null
    },
    listen: function () {
        if(! this.exists() )
            return;

        this.element.addEventListener('change', function () {
            jobExtensionsContainer.reset()

            let option = this.options[this.selectedIndex]

            if( option.dataset.hasExtensions > 0 )
                jobExtensionsContainer.add(this.value)
        })
    }
}
selectJob.listen()
</script>

@if( old('job') )
<script>selectJob.element.dispatchEvent( new Event('change') )</script>
@endif
