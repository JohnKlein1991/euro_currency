$(document).ready(()=>{
    setInterval(()=>{
        $('#'+updateButtonId).trigger('click');
    }, 1000);
});