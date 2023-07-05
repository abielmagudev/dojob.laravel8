if( typeof atticInsulationExtension == 'undefined' )
{
    const atticInsulationExtension = {
        methodElement: document.getElementById('aicSelectMethod'),
        rvalueElement: document.getElementById('aicSelectRValue'),
        squareFeetsElement: document.getElementById('aicInputSquareFeets'),
        totalBagsElement: document.getElementById('aicDivTotalBags'),
        calculateBagsBySquareFeets: function (square_feets, rvalue_amount) {
            if( rvalue_amount == 0 || isNaN(square_feets) || square_feets.trim() == "" )
                return 0;

            return Math.ceil( (square_feets / rvalue_amount) )
        },
        listen: function () {
            let self = this

            this.methodElement.addEventListener('change', function () {
                let optgroups = Array.from(self.rvalueElement.children)

                for(item of optgroups.splice(1))
                {
                    item.classList.add('d-none')

                    if( this.value == item.label.toLowerCase() )
                    {
                        self.rvalueElement.selectedIndex = 0
                        item.classList.remove('d-none')
                    }
                }

                self.totalBagsElement.textContent = 0
            })
    
            this.rvalueElement.addEventListener('change', function (e) {
                let option = this.options[e.target.selectedIndex]
                let rvalue_amount = option.dataset.amount ?? 0
                
                self.totalBagsElement.textContent = self.calculateBagsBySquareFeets(
                    self.squareFeetsElement.value,
                    rvalue_amount
                )
            })
    
            this.squareFeetsElement.addEventListener('keydown', function () {
                let option = self.rvalueElement.options[self.rvalueElement.selectedIndex]
                let rvalue_amount = option.dataset.amount ?? 0

                self.totalBagsElement.textContent = self.calculateBagsBySquareFeets(
                    this.value,
                    rvalue_amount
                )
            })
        }
    }
    
    atticInsulationExtension.listen()
}