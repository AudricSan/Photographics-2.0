var pre = document.querySelectorAll('pre')
const main = document.getElementsByTagName('main')
error = document.createElement('div')
main[0].appendChild(error);
error.classList.add('MyXdebug')

console.log(pre)

pre.forEach(e => {
    error.appendChild(e);
});