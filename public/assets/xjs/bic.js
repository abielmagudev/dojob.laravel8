if( typeof battInsulationExtension == 'undefined' )
{
    const battInsulationExtension = {
        methods: {
            element: document.getElementById('bic_selectMethod'),
            listen: function (callback) {
                this.element.addEventListener('change', function (e) {
                    let template_id = `bic_${e.target.value}RValuesOptionsTemplate`
                    let options = document.getElementById(template_id).content.cloneNode(true)
                    callback(options)
                })
            }
        },
        rvalues: {
            element: document.getElementById('bic_selectRValue'),
            clear: function () {
                while(this.element.children.length)
                    this.element.children[0].remove()
            },
            focus: function () {
                this.element.focus()
            },
            reload: function (options) {
                this.clear()
                this.element.appendChild(options)
            }
        },
        listen: function () {
            let self = this

            this.methods.listen( function (options) {
                self.rvalues.reload(options)
                self.rvalues.focus()
            })
        }
    }
    
    battInsulationExtension.listen()
}