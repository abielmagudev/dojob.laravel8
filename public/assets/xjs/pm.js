if( typeof preventiveMaintenanceExtension == 'undefined' )
{
    const preventiveMaintenanceExtension = {
        container: document.getElementById('pm_nextSchedulesContainer'),
        template: document.getElementById('pm_nextScheduleTemplate'),
        addButton: document.getElementById('pm_addNextScheduleButton'),
        listen: function () {
            let self = this

            this.addButton.addEventListener('click', function () {
                let total = self.container.children.length

                for(let index = 0; index < total; index++)
                {
                    self.container.children[index].querySelector('label').textContent = `${index+1}. Next schedule`
                }

                let clone = self.template.content.cloneNode(true)
                clone.querySelector('div > label').textContent = `${total+1}. Next schedule`
                self.container.appendChild(clone)
            })
        }
    }

    preventiveMaintenanceExtension.listen()
}
