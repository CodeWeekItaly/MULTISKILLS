const ps = document.querySelectorAll('p');
const hs = document.querySelectorAll('h1');
const hs1 = document.querySelectorAll('h3');

var scalingActive = false;

document.getElementById('text-size-btn').onclick=function()
{
        if(scalingActive)
        {
            document.querySelectorAll('p')
                .forEach(element => element.classList.remove('scale-text-max-p'))
            
            document.querySelectorAll('h1')
            .forEach(element => element.classList.remove('scale-text-max-h1'))

            document.querySelectorAll('h2')
            .forEach(element => element.classList.remove('scale-text-max-h1'))

            document.querySelectorAll('h3')
            .forEach(element => element.classList.remove('scale-text-max-h3'))


            globalThis.scalingActive = false;
        }
        else
        {

            document.querySelectorAll('p')
                .forEach(element => element.classList.add('scale-text-max-p'))

            document.querySelectorAll('h1')
            .forEach(element => element.classList.add('scale-text-max-h1'))
            
            document.querySelectorAll('h2')
            .forEach(element => element.classList.add('scale-text-max-h1'))

            document.querySelectorAll('h3')
            .forEach(element => element.classList.add('scale-text-max-h3'))
            

            globalThis.scalingActive = true;
        }
}