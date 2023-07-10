if( typeof atticInsulationExtension == 'undefined' )
{
    const atticInsulationExtension = {
        methods: {
            element: document.getElementById('aic_selectMethod'),
            listen: function (callback) {
                this.element.addEventListener('change', function (e) {
                    let template_id = `aic_${e.target.value}RValuesOptionsTemplate`
                    let options = document.getElementById(template_id).content.cloneNode(true)
                    callback(options)
                })
            }
        },
        rvalues: {
            element: document.getElementById('aic_selectRValue'),
            clear: function () {
                while(this.element.children.length)
                    this.element.children[0].remove()
            },
            reload: function (options) {
                this.clear()
                this.element.appendChild(options)
            },
            amount: function () {
                let option = this.element.options[this.element.selectedIndex]
                return option.dataset.amount ?? 0
            },
            listen: function (callback) {
                this.element.addEventListener('change', function (e) {
                    let option = e.target.options[ e.target.selectedIndex ]
                    let amount = option.dataset.amount ?? 0
                    callback(amount)
                })
            }
        },
        squarefeets: {
            element: document.getElementById('aic_inputSquareFeets'),
            events: ['input', 'paste'],
            value: function () {
                return this.element.value ?? 0
            },
            listen: function (callback) {
                let element = this.element
                this.events.forEach(function (type) {
                    element.addEventListener(type, (e) => callback(e.target.value) )
                })
            }
        },
        bags: {
            element: document.getElementById('aic_divBags'),
            calculate: function (square_feets, rvalue_amount) {
                if( rvalue_amount == 0 || isNaN(square_feets) || square_feets.trim() == "" )
                    return 0;

                return Math.ceil( (square_feets / rvalue_amount) )               
            },
            result: function (square_feets, rvalue_amount) {
                let result = this.calculate(square_feets, rvalue_amount)
                this.element.textContent = result
            },
            zero: function () {
                this.element.textContent = 0
            }
        },
        listen: function () {
            let self = this

            this.methods.listen( function (options) {
                self.rvalues.reload(options)
                self.bags.zero()
            })

            this.rvalues.listen( function (amount) {                
                self.bags.result(self.squarefeets.value(), amount)
            })

            this.squarefeets.listen( function (value) {
                self.bags.result(value, self.rvalues.amount())
            })
        }
    }
    
    atticInsulationExtension.listen()
}