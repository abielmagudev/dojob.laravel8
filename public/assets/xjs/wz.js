if( typeof weatherizationProductsExtension == 'undefined' )
{
    const weatherizationProductsExtension = {
        element: document.getElementById('weatherizationExtension'),
        template: function(setup) {
            let cloned = this.element.querySelector('#productTemplate').content.cloneNode(true);

            let option = document.createElement('option')
            option.value = setup.product
            option.text = setup.text

            cloned.querySelector('select').appendChild(option)

            cloned.querySelector('input').value = setup.quantity

            return cloned;
        },
        add: function (cloned) {
            this.element.querySelector('#addedProducts').appendChild(cloned);
        },
        listen: function () {
            let self = this

            this.element.querySelector('#productSetup').addEventListener('click', function (e) {
                if(! e.target.matches('button, button > i') )
                    return;

                let selectProduct = this.querySelector('select')
                if( selectProduct.value == '' )
                {
                    selectProduct.focus()
                    return;
                }

                let inputQuantity = this.querySelector('input')
                if( inputQuantity.value == '' || inputQuantity.value < 1 )
                {
                    inputQuantity.focus()
                    return;
                }

                let cloned = self.template({
                    text: selectProduct.options[ selectProduct.selectedIndex ].textContent,
                    product: selectProduct.value,
                    quantity: inputQuantity.value
                });

                self.add(cloned)

                selectProduct.selectedIndex = 0
                inputQuantity.value = ''
            })

            this.element.querySelector('#addedProducts').addEventListener('click', function (e) {
                if(! e.target.matches('button, button > i') )
                    return;

                e.target.closest('.row').remove()
            })
        }
    }

    weatherizationProductsExtension.listen();
}
