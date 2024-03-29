function confirmClear(event) 
{
    mssg = document.getElementById('securityextend_confirm_clear').title;
    if (confirm(mssg)) {
        return true;
    }
    event.preventDefault();
    return false;
}

document.addEventListener('DOMContentLoaded', function () 
{
    var elems = document.getElementsByClassName('securityextend-clear');
    for (var i = 0; i < elems.length; i++) {
        elems[i].addEventListener('click', confirmClear);
    }
});
