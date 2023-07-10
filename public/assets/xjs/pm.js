if( typeof preventiveMaintenanceExtension == 'undefined' )
{
    const preventiveMaintenanceExtension = {
        adder: document.getElementById('pm_addNextScheduleButton'),
        template: {
            element: document.getElementById('pm_nextScheduleTemplate'),
            clone: function () {
                return this.element.content.cloneNode(true)
            }
        },
        container: {
            element: document.getElementById('pm_nextSchedulesContainer'),
            append: function (element) {
                this.element.appendChild(element)
            },
            childrenCount: function () {
                return this.element.children.length
            },
            reindex: function () {
                let children_count_cache = this.childrenCount()

                for(let index = 0; index < children_count_cache; index++)
                {
                    let number = index + 1 
                    let new_id = "nextScheduleInput" + number
                    this.element.children[index].querySelector('label').textContent = `${number}. Next schedule`
                    this.element.children[index].querySelector('label').setAttribute('for', new_id)
                    this.element.children[index].querySelector('input').id = new_id
                }
            },
            delegateActionRemoveButtons: function () {
                let self = this

                this.element.addEventListener('click', function (e) {
                    if( e.target.classList.contains('pm_removeNextScheduleButton') )
                    {
                        e.preventDefault()
                        e.target.closest('div.pm_nextScheduleWrapper').remove()
                    }
    
                    e.stopPropagation()
                    self.reindex()
                })
            }
        },
        listen: function () {
            let container = this.container
            let template = this.template
            
            container.delegateActionRemoveButtons()

            this.adder.addEventListener('click', function () {
                let number = container.childrenCount() + 1
                let clone = template.clone()
                clone.querySelector('label').textContent = `${number}. Next schedule`
                container.append(clone)
                container.reindex()
            })
        }
    }

    preventiveMaintenanceExtension.listen()
}
