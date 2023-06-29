if( typeof atticInsulationExtension === 'undefined' )
{
    const atticInsulationExtension = {
        methodElement: document.getElementById('aicSelectMethod'),
        rvalueElement: document.getElementById('aicSelectRValue'),
        squareFeetsElement: document.getElementById('aicInputSquareFeets'),
        listen: function () {
            this.methodElement.addEventListener('change', function () {
                console.log('Method changed!')
            })
    
            this.rvalueElement.addEventListener('change', function () {
                console.log('R-Value changed!')
            })
    
            this.squareFeetsElement.addEventListener('keydown', function () {
                console.log('Square feets changed!')
            })
        }
    }
    
    atticInsulationExtension.listen()
}